create schema livros;

use livros;

create table livros(
livro_id int (11) primary key auto_increment not null,
titulo varchar (255) not null,
autor varchar (255) not null,
classificacao varchar (255) not null
);

create table leitor(
leitor_id int (11) primary key auto_increment not null,
nome_leitor varchar (100) not null,
nascimento date not null,
qntd_amigos int (4)
);

create table leitura(
livro_id int (11),
leitor_id int (11),
constraint fk_leituraleitor foreign key (leitor_id) 
references leitor(leitor_id),
constraint fk_leituralivro foreign key (livro_id) 
references livros(livro_id)
);

create table amizade(
leitorum_id int (11),
leitordois_id int (11),
constraint fk_amizadeleitorum foreign key (leitorum_id) 
references leitor(leitor_id),
constraint fk_amizadeleitordois foreign key (leitordois_id) 
references leitor(leitor_id)
);

alter table livros add column anopubli int (4) not null;

insert into livros values(null,'Dom Casmurro','Machado de Assis','Romance','1800');
insert into livros values(null,'Senhor dos Anéis','J. R. R. Tolkien','Infanto-Juvenil','1996');
insert into livros values(null,'Harry Potter','J. K. Rowling','Infanto-Juvenil','1999');
insert into livros values(null,'Carrie','Stephen King','Terror','1970');
insert into livros values(null,'Frankestein','Mary Shelley','Romance','1800');

insert into leitor values(null,'Mônica',str_to_date('15/05/1995','%d/%m/%Y'),'5');
insert into leitor values(null,'Julianna',str_to_date('02/07/2004','%d/%m/%Y'),'2');
insert into leitor values(null,'Orlei',str_to_date('26/04/1969','%d/%m/%Y'),'7');
insert into leitor values(null,'Lúcia',str_to_date('29/11/1970','%d/%m/%Y'),'12');

alter table leitura add column inicio date;
alter table leitura add column fim date;

select * from livros where titulo like 'Senhor dos Anéis';

insert into leitura values('2','1',str_to_date('01/01/2022','%d/%m/%Y'),str_to_date('20/01/2022','%d/%m/%Y'));
insert into leitura values('5','4',str_to_date('15/02/2022','%d/%m/%Y'),str_to_date('20/02/2022','%d/%m/%Y'));
insert into leitura values('1','3',str_to_date('01/04/2022','%d/%m/%Y'),str_to_date('05/04/2022','%d/%m/%Y'));
insert into leitura values('3','2',str_to_date('08/02/2022','%d/%m/%Y'),str_to_date('07/04/2022','%d/%m/%Y'));

alter table amizade add column solicitacao varchar (100);
 
insert into amizade values('1','2','Confirmada');
insert into amizade values('1','3','Negada');
insert into amizade values('2','3','Confirmada');
insert into amizade values('3','4','Negada');

select l1.nome_leitor leitor1,
  l2.nome_leitor leitor2,
  solicitacao
  from amizade
  inner join leitor l1 on (l1.leitor_id=amizade.leitorum_id)
  inner join leitor l2 on (l2.leitor_id=amizade.leitordois_id);
  
create table biblioteca(
biblioteca_id int (11) primary key auto_increment not null,
livro_id int (11),
leitor_id int (11),
constraint fk_bibliotecaleitor foreign key (leitor_id) 
references leitor(leitor_id),
constraint fk_livro foreign key (livro_id) 
references livros(livro_id)
);

insert into biblioteca values(null,'2','1');
insert into biblioteca values(null,'3','1');
insert into biblioteca values(null,'5','1');
insert into biblioteca values(null,'1','2');

select distinct l1.nome_leitor leitor,
  l2.titulo livro,
  inicio,
  fim
  from leitura
  inner join leitor l1 on (l1.leitor_id=leitura.leitor_id)
  inner join livros l2 on (l2.livro_id=leitura.livro_id);

select l1.nome_leitor leitor,
  l2.titulo livro
  from biblioteca
  inner join leitor l1 on (l1.leitor_id=biblioteca.leitor_id)
  inner join livros l2 on (l2.livro_id=biblioteca.livro_id);

create view vw_livro_autor as
select titulo, 
	   autor
       from livros li
       where li.autor is not null
       group by autor
       order by autor;
       
 delimiter $
create function insert_livro( titulo varchar(255))
returns varchar(255)
deterministic
no sql
begin
	insert into livros ( titulo )
				values( titulo );
	return (titulo);
end$ 
delimiter ;
			
alter table livros modify autor varchar(255) default null;
alter table livros modify classificacao varchar(255) default null;
alter table livros modify anopubli int(4) default null;

select insert_livro('Jogos Vorazes');

select * from livros;

create procedure ver_classificacao(livro varchar(255))
	select titulo
		as titulo_li,
		   classificacao
		from livros
        where titulo = livro;

call ver_classificacao('Harry Potter');

show variables like 'event%';

select * from leitor;

delimiter $
create event inserir_leitor
on schedule at current_timestamp
do begin
	insert into leitor(nome_leitor)
    values ('Giovani');
end $
delimiter ;
    
delimiter $
create event inserir_amizade_sem
on schedule at now() + interval 1 week
do begin
	insert into amizade(leitorum_id,leitordois_id)
    values ('2','5');
end $
delimiter ;

delimiter $
create event inserir_amizade_mes
on schedule at now() + interval 1 month
do begin
	insert into amizade(leitorum_id,leitordois_id)
    values('1','5');
end $
delimiter ;

show events from livros;
