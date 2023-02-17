create table demande (
  D_id int(8) not null primary key Auto_increment,
  D_date_intervention int not null,
  D_message varchar(100) not null,
  D_etat varchar(50) not null,
  D_adresse varchar(50) not null,
  D_date_demande int not null,
  D_idClient int not null,
  D_idService int not null
)

ALTER TABLE demande ADD CONSTRAINT fk_demande_user FOREIGN KEY (D_idClient) REFERENCES user(U_id);

ALTER TABLE demande ADD CONSTRAINT fk_demande_service FOREIGN KEY (D_idService) REFERENCES service(S_id);
