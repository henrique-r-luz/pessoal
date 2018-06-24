-- tipos de investimentos da corretora
create table categorias(
 id int  NOT NULL primary key,
 nome text

);


-- relata as atualizações do sistema
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
        taxa text,
	valor_compra real,
	valor_venda real,
        atualizacao_id int  NOT NULL REFERENCES atualizacao ,
        categoria_id int  NOT NULL  REFERENCES categorias,
        UNIQUE (id, atualizacao_id)
        
      
);



