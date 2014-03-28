
create table COWORKERs (
	id_coworker INTEGER PRIMARY KEY 
	,
	nom_coworker VARCHAR(200) NOT NULL
	,
	adresse_coworker VARCHAR(200) NOT NULL
	,
	code_postal_coworker VARCHAR(200) NOT NULL
	,
	ville_coworker VARCHAR(200) NOT NULL
	,
	email_coworker VARCHAR(200) NOT NULL
	,
	nom_facture_coworker VARCHAR(200) NOT NULL
	,
	dt_install VARCHAR(200) NOT NULL
	,
	dt_end VARCHAR(200) NOT NULL
	,
	name_bdd VARCHAR(200) NOT NULL
);


create table FACTUREs (
	id_facture INTEGER PRIMARY KEY 
	,
	id_coworker	INTEGER NOT NULL
	,
	numero_facture VARCHAR(200) NOT NULL
	,
	date_facture VARCHAR(200) NOT NULL
	,
	montant_facture VARCHAR(200) NOT NULL
	,
	url_pdf VARCHAR(200) NOT NULL
	,
	affiche_tva BOOL NOT NULL
	,
	montant_reduction VARCHAR(200) NOT NULL
	,
	libelle_reduction VARCHAR(200) NOT NULL
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
	offert BOOL NOT NULL
,
 	CONSTRAINT offert_UNIQUE UNIQUE(offert)
);
