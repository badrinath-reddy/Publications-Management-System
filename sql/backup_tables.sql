create table departments(
dept_id int(10)  auto_increment,
name varchar(30) unique,
dept_code varchar(20),
constraint department_pk 
primary key(dept_id));


create table hashtags(
tag_id int(10)  auto_increment,
tag varchar(30) unique,
constraint hashtags_pk
primary key(tag_id));


create table people(
people_id varchar(30),
name varchar(30) not null,
password varchar(30),
is_admin int(2) not null,
is_faculty int(2) not null,
constraint people_pk
primary key(people_id));


create table projects(
project_id int(30) auto_increment,
name varchar(100),
duration float(3, 2) not null,
start_date date not null,
status int(2) not null,
cost float(10, 2) not null,
link varchar(70),
constraint projects_pk
primary key(project_id));


create table publications(
publication_id int(30) auto_increment,
name varchar(250) not null,
p_year year not null,
p_month int(2),
page_range varchar(30),
doi varchar(50),
link varchar(70),
constraint publications_pk
primary key(publication_id));


create table organisations(
organisation_id int(10) auto_increment,
name varchar(50) not null,
p_g int(2) not null,
address varchar(250),
has_people int(2) not null,
constraint organisatiion_pk 
primary key(organisation_id));


create table journal(
publication_id int(10),
name varchar(100) not null,
volume int(10) not null,
issue_no int(10) not null,
constraint journal_pk
primary key(publication_id),
constraint journal_fk1 
foreign key(publication_id) 
references publications(publication_id));


create table conference(
publication_id int(10),
name varchar(100) not null,
place varchar(30) not null,
constraint conference_pk
primary key(publication_id),
constraint conference_fk1 
foreign key(publication_id) 
references publications(publication_id));

create table consortina_partners(
project_id int(10),
organisation_id int(10),
constraint consortina_partners_pk
primary key(project_id, organisation_id),
constraint consortina_partners_fk1
foreign key(project_id)
references projects(project_id),
constraint consortina_partners_fk2
foreign key(organisation_id)
references organisations(organisation_id));


create table sponsored_by(
project_id int(10),
organisation_id int(10),
amount int(10) not null,
constraint sponsored_by_pk
primary key(project_id, organisation_id),
constraint sponsored_by_fk1
foreign key(project_id)
references projects(project_id),
constraint sponsored_by_fk2
foreign key(organisation_id)
references organisations(organisation_id));

create table done_by(
project_id int(10),
people_id varchar(30),
level int(3) not null,
constraint done_by_pk
primary key(project_id, people_id),
constraint done_by_fk1
foreign key(project_id)
references projects(project_id),
constraint done_by_fk2
foreign key(people_id)
references people(people_id));


create table written_by(
publication_id int(10),
people_id varchar(30),
level int(3) not null,
constraint written_by_pk
primary key(publication_id, people_id),
constraint written_by_fk1
foreign key(publication_id)
references publications(publication_id),
constraint written_by_fk2
foreign key(people_id)
references people(people_id));


create table affilliated_to(
people_id varchar(10),
organisation_id int(10),
constraint affilliated_to_pk
primary key(people_id, organisation_id),
constraint affilliated_to_fk1
foreign key(people_id)
references people(people_id),
constraint affilliated_to_fk2
foreign key(organisation_id)
references organisations(organisation_id));


create table has_tags_proj(
tag_id int(10),
project_id int(10),
constraint has_tags_proj_pk
primary key(tag_id, project_id),
constraint has_tags_proj_fk1 
foreign key(tag_id)
references hashtags(tag_id),
constraint has_tags_proj_fk2 
foreign key(project_id)
references projects(project_id));


create table has_tags_pub(
tag_id int(10),
publication_id int(10),
constraint has_tags_pub_pk
primary key(tag_id, publication_id),
constraint has_tags_pub_fk1 
foreign key(tag_id)
references hashtags(tag_id),
constraint has_tags_pub_fk2 
foreign key(publication_id) 
references publications(publication_id));


Create table belongs_to(
people_id varchar(30),
dept_id int(10),
constraint belongs_to
primary key(people_id,dept_id),
constraint belongs_to_fk1 
foreign key(dept_id)
references departments(dept_id),
constraint belongs_to_fk2 
foreign key(people_id) 
references people(people_id));