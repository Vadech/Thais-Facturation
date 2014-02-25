
create table HOTELs (
	id_hotel INTEGER PRIMARY KEY 
	,
	factures  NOT NULL
	,
	nom_hotel VARCHAR(200) NOT NULL
	,
	adresse_hotel VARCHAR(200) NOT NULL
	,
	code_postal_hotel VARCHAR(200) NOT NULL
	,
	ville_hotel VARCHAR(200) NOT NULL
	,
	email_hotel VARCHAR(200) NOT NULL
	,
	web_hotel VARCHAR(200) NOT NULL
	,
	gerant_hotel VARCHAR(200) NOT NULL
	,
	contact_hotel VARCHAR(200) NOT NULL
	,
	dt_install VARCHAR(200) NOT NULL
	,
	dt_trialend VARCHAR(200) NOT NULL
	,
	dt_end VARCHAR(200) NOT NULL
);


create table FACTUREs (
	id_facture INTEGER PRIMARY KEY 
	,
	id_hotel	INTEGER NOT NULL
	,
	numero_facture VARCHAR(200) NOT NULL
	,
	date_facture VARCHAR(200) NOT NULL
	,
	montant_facture VARCHAR(200) NOT NULL
	,
	url_pdf VARCHAR(200) NOT NULL
	,
	affice_tva BOOL NOT NULL
	,
	montant_reduction VARCHAR(200) NOT NULL
	,
	libelle_reduction VARCHAR(200) NOT NULL
);




