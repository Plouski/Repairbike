create table service (
  S_id int(8) not null primary key Auto_increment,
  S_tarif int not null,
  S_description varchar(50),
  S_titre varchar(5) not null,
  S_rayon_intervention varchar(50) not null,
  S_idReparateur int not null
)

ALTER TABLE service ADD CONSTRAINT fk_service_reparateur FOREIGN KEY (S_idReparateur) REFERENCES user(U_id);
