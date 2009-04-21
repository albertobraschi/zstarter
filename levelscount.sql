CREATE FUNCTION LEVELSCOUNT (str VARCHAR(255), delimitr CHAR(1)) RETURNS INT
DETERMINISTIC
READS SQL DATA
BEGIN
DECLARE _cnt INT;
DECLARE _start INT;
SET _cnt = -1;
SET _start = 1;
WHILE _start > 0 DO
	SET _start = LOCATE(delimitr, str);
	SET str = SUBSTRING(str, _start + 1);
	SET _cnt = _cnt+1;
END WHILE;
RETURN _cnt;
END;

drop function if exists next_path;

/*
set _path_new = concat(_path,'.',substring_index(_path,'.',-1)+1); 
declare _last VARCHAR(255);

set _path_new = replace(_path,_last,_last+1);
set _path_new = concat(_path,'.',+1);
set _last = substring_index(_path,'.',-1);
*/

/*
-----
@ident
при додатньому значенні - ідентифікатор батьківського коментаря
при від'ємному - ідентифікатор батьківського поста
-----
@connection
прив'язка коментарів до батьківських топ-елементів (пости, фотки, проекти в портфоліо)
-----
bugs:
+ при введені мінусового ідентифікатора, тобто ідентифікатора на батьківський топ-елемент, котрого не існує - функція все одно повертає значення 1. По правильному повинно поверати NULL.
*/
create function next_path (ident INT(10), connection INT(10), d INT(10)) RETURNS VARCHAR(255)
DETERMINISTIC
reads sql data
begin
	declare _path_new VARCHAR(255);
	declare _post_id INT(10);
	declare _connection_id INT(10);
	declare _path VARCHAR(255);

	if ident>0 then	

		set _path = (select s.Path from site_comments_tree_mp s where s.ID=ident);
		set _post_id = (select s.Parent_id from site_comments s where s.ID=ident);
		set _connection_id = (select s.Connection_id from site_comments s where s.ID=ident);
		set _path = replace(_path,'.','\.');

		if (select count(id) from site_comments_tree_mp where Path regexp concat('^',_path,'\.[0-9]+$'))>0 then
			set _path = (
				select Path
				from site_comments_tree_mp
				where Path regexp concat('^',_path,'\.[0-9]+$')
				order by Path desc
				limit 1
			);
			set _path_new = concat(substring_index(_path,'.',levelscount(_path,'.')),'.',digit(substring_index(_path,'.',-1)+1,d));
		else
			set _path_new = concat(_path,'.', digit(1, d));
		end if;
	else
        if (select count(mp.id) from site_comments_tree_mp mp) > 0 then
		    set _path_new = digit(1+(
			    select sm.Path
			    from site_comments s, site_comments_tree_mp sm
			    where s.ID=sm.ID
			    and s.Parent_id=(-1)*ident
			    and s.Connection_id=connection
    			and sm.Path regexp '^[0-9]+$'
			    order by sm.Path desc
			    limit 1), d);
        else
            set _path_new = digit(1, d);
        end if;
	end if;
	return _path_new;
end;

//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

create function digit (numb INT(10), digits INT(10)) RETURNS VARCHAR(255)
DETERMINISTIC
reads sql data
begin
    declare _numb VARCHAR(255);
    declare l INT(10);
    declare i INT(10);
    if numb = NULL then
        set numb=0;
    end if;
    set _numb = numb;
    set l = digits - length(_numb);
    set i = 0;
    while i<l do
        set _numb = concat('0',_numb);
        set i = i + 1;
    end while;
    return _numb;
end;