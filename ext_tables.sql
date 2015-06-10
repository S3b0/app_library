#
# Table structure for table 'sys_category'
#
CREATE TABLE sys_category (
	tx_realurl_pathsegment VARCHAR(255) DEFAULT '' NOT NULL
);

#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	tx_applib_mode int(11) unsigned NOT NULL default '0'
);

#
# Table structure for table 'tx_applib_domain_model_app'
#
CREATE TABLE tx_applib_domain_model_app (

	uid int(11) NOT NULL auto_increment,
	pid int(11) NOT NULL default '0',

	title varchar(255) NOT NULL default '',
	file_reference int(11) unsigned NOT NULL default '0',
	preview_images int(11) unsigned NOT NULL default '0',
	youtube_links text NOT NULL,
	file_size double(11,2) DEFAULT '0.00' NOT NULL,
	external_url varchar(255) NOT NULL default '',
	icon int(11) unsigned NOT NULL default '0',
	version varchar(255) NOT NULL default '',
	featured_until date default '0000-00-00',
	features text NOT NULL,
	description text NOT NULL,
	system_requirements text NOT NULL,
	release_date date default '0000-00-00',
	last_modified date default '0000-00-00',
	supported_operating_systems int(11) unsigned NOT NULL default '0',
	views int(11) unsigned NOT NULL default '0',
	downloads int(11) unsigned NOT NULL default '0',
	settings int(11) unsigned NOT NULL default '0',
	page varchar(255) NOT NULL default '',
	rating double(11,2) NOT NULL default '0.00',
	votes int(11) unsigned NOT NULL default '0',
	supported_languages int(11) unsigned NOT NULL default '0',
	related int(11) unsigned NOT NULL default '0',
	recommended int(11) unsigned NOT NULL default '0',
	provider int(11) unsigned NOT NULL default '0',
	developer int(11) unsigned NOT NULL default '0',
	copyright_holder int(11) unsigned NOT NULL default '0',
	tags int(11) unsigned NOT NULL default '0',
	fe_group varchar(100) NOT NULL default '0',
	products int(11) unsigned NOT NULL default '0',
	categories int(11) unsigned NOT NULL default '0',
	tx_realurl_pathsegment VARCHAR(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned NOT NULL default '0',
	crdate int(11) unsigned NOT NULL default '0',
	cruser_id int(11) unsigned NOT NULL default '0',
	deleted tinyint(4) unsigned NOT NULL default '0',
	hidden tinyint(4) unsigned NOT NULL default '0',
	starttime int(11) unsigned NOT NULL default '0',
	endtime int(11) unsigned NOT NULL default '0',

	sorting int(11) NOT NULL default '0',

	sys_language_uid int(11) NOT NULL default '0',
	l10n_parent int(11) NOT NULL default '0',
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_applib_domain_model_faq'
#
CREATE TABLE tx_applib_domain_model_faq (

	uid int(11) NOT NULL auto_increment,
	pid int(11) NOT NULL default '0',

	title varchar(255) NOT NULL default '',
	answer text NOT NULL,
	date date default '0000-00-00',
	inquirer varchar(255) NOT NULL default '',
	responder varchar(255) NOT NULL default '',
	app int(11) unsigned NOT NULL default '0',

	tstamp int(11) unsigned NOT NULL default '0',
	crdate int(11) unsigned NOT NULL default '0',
	cruser_id int(11) unsigned NOT NULL default '0',
	deleted tinyint(4) unsigned NOT NULL default '0',
	hidden tinyint(4) unsigned NOT NULL default '0',
	starttime int(11) unsigned NOT NULL default '0',
	endtime int(11) unsigned NOT NULL default '0',

	sorting int(11) NOT NULL default '0',

	sys_language_uid int(11) NOT NULL default '0',
	l10n_parent int(11) NOT NULL default '0',
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_applib_domain_model_provider'
#
CREATE TABLE tx_applib_domain_model_provider (

	uid int(11) NOT NULL auto_increment,
	pid int(11) NOT NULL default '0',

	title varchar(255) NOT NULL default '',
	websites text NOT NULL,

	tstamp int(11) unsigned NOT NULL default '0',
	crdate int(11) unsigned NOT NULL default '0',
	cruser_id int(11) unsigned NOT NULL default '0',
	deleted tinyint(4) unsigned NOT NULL default '0',
	hidden tinyint(4) unsigned NOT NULL default '0',

	sorting int(11) NOT NULL default '0',

	PRIMARY KEY (uid),
	KEY parent (pid)

);

#
# Table structure for table 'tx_applib_domain_model_tag'
#
CREATE TABLE tx_applib_domain_model_tag (

	uid int(11) NOT NULL auto_increment,
	pid int(11) NOT NULL default '0',

	title varchar(255) NOT NULL default '',
	tx_realurl_pathsegment VARCHAR(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned NOT NULL default '0',
	crdate int(11) unsigned NOT NULL default '0',
	cruser_id int(11) unsigned NOT NULL default '0',
	deleted tinyint(4) unsigned NOT NULL default '0',
	hidden tinyint(4) unsigned NOT NULL default '0',

	sorting int(11) NOT NULL default '0',

	sys_language_uid int(11) NOT NULL default '0',
	l10n_parent int(11) NOT NULL default '0',
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_applib_domain_model_log'
#
CREATE TABLE tx_applib_domain_model_log (

	uid int(11) NOT NULL auto_increment,
	pid int(11) NOT NULL default '0',

	name varchar(255) NOT NULL default '',
	company varchar(255) NOT NULL default '',
	email varchar(255) NOT NULL default '',
	address varchar(255) NOT NULL default '',
	city varchar(255) NOT NULL default '',
	zip varchar(255) NOT NULL default '',
	country varchar(255) NOT NULL default '0',
	state_province varchar(255) default NULL,
	fe_user int(11)  default NULL,
	app int(11) NOT NULL default '0',

	tstamp int(11) unsigned NOT NULL default '0',

	PRIMARY KEY (uid),
	KEY parent (pid)

);

#
# Table structure for table 'tx_applib_app_language_mm'
#
CREATE TABLE tx_applib_app_language_mm (
	uid_local int(11) unsigned NOT NULL default '0',
	uid_foreign int(11) unsigned NOT NULL default '0',
	sorting int(11) unsigned NOT NULL default '0',
	sorting_foreign int(11) unsigned NOT NULL default '0',

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_applib_app_app_mm'
#
CREATE TABLE tx_applib_app_app_mm (
	uid_local int(11) unsigned NOT NULL default '0',
	uid_foreign int(11) unsigned NOT NULL default '0',
	sorting int(11) unsigned NOT NULL default '0',
	sorting_foreign int(11) unsigned NOT NULL default '0',

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_applib_app_recommended_app_mm'
#
CREATE TABLE tx_applib_app_recommended_app_mm (
	uid_local int(11) unsigned NOT NULL default '0',
	uid_foreign int(11) unsigned NOT NULL default '0',
	sorting int(11) unsigned NOT NULL default '0',
	sorting_foreign int(11) unsigned NOT NULL default '0',

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_applib_app_tag_mm'
#
CREATE TABLE tx_applib_app_tag_mm (
	uid_local int(11) unsigned NOT NULL default '0',
	uid_foreign int(11) unsigned NOT NULL default '0',
	sorting int(11) unsigned NOT NULL default '0',
	sorting_foreign int(11) unsigned NOT NULL default '0',

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_applib_app_product_mm'
#
CREATE TABLE tx_applib_app_product_mm (
	uid_local int(11) unsigned NOT NULL default '0',
	uid_foreign int(11) unsigned NOT NULL default '0',
	sorting int(11) unsigned NOT NULL default '0',
	sorting_foreign int(11) unsigned NOT NULL default '0',

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_applib_faq_app_mm'
#
CREATE TABLE tx_applib_faq_app_mm (
	uid_local int(11) unsigned NOT NULL default '0',
	uid_foreign int(11) unsigned NOT NULL default '0',
	sorting int(11) unsigned NOT NULL default '0',
	sorting_foreign int(11) unsigned NOT NULL default '0',

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);
