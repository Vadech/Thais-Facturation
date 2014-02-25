
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
	,
	name_bdd VARCHAR(200) NOT NULL
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
	,
	facture_option 
,
 	CONSTRAINT facture_option_UNIQUE UNIQUE(facture_option)
);


create table OPTIONs (
	id_option INTEGER PRIMARY KEY 
	,
	libelle VARCHAR(200) NOT NULL
,
 	CONSTRAINT libelle_UNIQUE UNIQUE(libelle)
	,
	tarif INTEGER NOT NULL
,
 	CONSTRAINT tarif_UNIQUE UNIQUE(tarif)
);


create table FACTURE_OPTIONs (
	id_facture_option INTEGER PRIMARY KEY 
	,
	id_facture	INTEGER
	,
	id_option	INTEGER NOT NULL
	,
	option  NOT NULL
,
 	CONSTRAINT option_UNIQUE UNIQUE(option)
	,
	offert BOOL NOT NULL
,
 	CONSTRAINT offert_UNIQUE UNIQUE(offert)
);




