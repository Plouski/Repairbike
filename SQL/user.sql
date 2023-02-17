create table user (
  U_id int not null primary key Auto_increment,
  U_nom varchar(50) not null,
  U_prenom varchar(50) not null,
  U_email varchar(50) not null,
  U_mdp varchar(50) not null,
  U_tel varchar(50) not null,
  U_adresse varchar(50) not null,
  U_reparateur boolean  not null,
  U_status varchar(50) not null
)
