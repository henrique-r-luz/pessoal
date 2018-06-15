create table categorias(
 id serial primary key,
 nome text

);

create table atualizacao(
  id serial primary key,
  data date,
  valor_total real
);

--banco titlos financeiros
create table titulos(
	id serial primary key,
	ativo text,
	emissor text,
	quantidade real,
	tributos real,
	valor_compra real,
	valor_venda real,
        atualizacao_id int  REFERENCES atualizacao ,
        categoria_id int  REFERENCES categorias
        
      
);



