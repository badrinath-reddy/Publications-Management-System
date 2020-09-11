-- ** Hashtags **
-- tag_id int(10) auto_increment, tag varchar(30)

insert into hashtags
values
(1, 'Machine Learning'),
(2, 'Deep Learning'),
(3, 'NLP'),
(4, 'DMBS'),
(5, 'Computer Networks'),
(6, 'OS'),
(7, 'Graphics'),
(8, 'Cloud'),
(9, 'Vision'),
(10, 'Health Care');

insert into hashtags(tag)
values
('Robotics');
-- ----------------------------------------------------------------------------------------------------------------
-- ** People **
-- people_id varchar(30), name varchar(30), is_admin int(2), is_faculty int(2)

insert into people 
values
('1701CS22', 'Badrinath Gopugari','1234', 1, 0),
('1701CS53', 'Vrushank Varma','1234', 1, 0),
('1701CS15', 'Dhanvanth','1234', 0, 0),
('1701CS23', 'Sagar','1234', 0, 0),
('1701CS54', 'Sujeeth','1234', 0, 0),
('FCS252', 'Samrat', '1234',1, 1),
('FME282', 'Atul', '1234',0, 1),
('FME252', 'Ajay','1234', 0, 1),
('1701ME19', 'Harshith','1234', 0, 0),
('1701ME22', 'Devi','1234', 0, 0);
-- -------------------------------------------------------------------------------------------------------------------------
-- ** Projects **
-- project_id varchar(30) auto_increment, name varchar(100), duration float(3,2) not null,  start_date date not null,status int(2) not null,cost float(10, 3) not null,link varchar(70)


insert into projects
values
(1, 'Summarisation', 3.2, '2005-08-23', 1, 124.3, 'hwebfjvhqewj'),
(2, 'NLP survey', 3, '2006-08-23', 1.5, 14.3, 'hwebfjvhqewj'),
(3, 'CV survey', 3, '2007-08-23', 1.6, 12.3, 'hwebfjvhqewj'),
(4, 'Arch', 2, '2008-08-23', 1, 1245.3, 'hwebfjvhqewj'),
(5, 'Robot in sewer', 5, '2009-08-23', 1, 1.3, 'hwebfjvhqewj'),
(6, 'Emotion', 5, '2015-08-23', 1, 2.3, 'hwebfjvhqewj'),
(7, 'Dipression', 9, '2016-08-23', 1, 124.5, 'hwebfjvhqewj'),
(8, 'Solid works', 3.4, '2017-08-23', 1, 34, 'hwebfjvhqewj'),
(9, 'Cad', 2.3, '2019-08-23', 1, 88, 'hwebfjvhqewj'),
(10, 'VLSI', 3.3, '2020-08-23', 1, 56, 'hwebfjvhqewj');

-- -----------------------------------------------------------------------------------------------------------------------
-- **Organisations**
-- organisation_id int(10) auto_increment, name varchar(30),p_g int(2), address varchar(250),has_people int(2),

insert into organisations
values
(1, 'Indian Institue of Technology Patna',0,'Bihar',1),
(2, 'Indian Institue of Technology Bombay',0,'Bihar',1),
(3, 'Indian Institue of Technology Madras',0,'Bihar',1),
(4, 'Indian Institue of Technology Hydereabad',0,'Bihar',1),
(5, 'Indian Institue of Technology Ropar',0,'Bihar',1),
(6, 'Indian Institue of Technology Delhi',0,'Bihar',1),
(7, 'Indian Institue of Technology Kanpur',0,'Bihar',1),
(8, 'Indian Institue of Technology Roorke',0,'Bihar',1),
(9, 'IBM',0,'Bihar',1),
(10, 'Samsung',0,'Bihar',0);


insert into organisations(name, p_g, address, has_people)
values
('Indian Institue of Technology Tirupati', 0, 'Tirupati', 1);
-- ------------------------------------------------------------------------------------------------------
-- **Departments**
-- dept_id int(10) auto_increment, name varchar(30)

insert into departments
values
(1, 'CSE', 'CSE'),
(2, 'EE', 'EE'),
(3, 'ME', 'ME'),
(4, 'CE', 'CE'),
(5, 'CB', 'CB'),
(6, 'HS', 'HS');
-- ----------------------------------------------------------------------------------------------------------------------
-- **Publications**
-- publication_id int(30) auto_increment,name varchar(100),p_year year,p_month int(2),page_range varchar(30),doi varchar(50),link varchar(70)

insert into publications
values
(1,'voice recognition based on nlp', '2015', 4, '10-12', 'mjfvweawa', 'mhjvdhfvker'),
(2,'Robotic arm', '2016', 3, '10-12', 'mjfvweawa', 'mhjvdhfvker'),
(3,'Divide-and-Conquer Based Non-dominated Sorting with Reduced Comparisons ', '2017', 6, '10-12', 'mjfvweawa', 'mhjvdhfvker'),
(4,'On overcoming the identified limitations of a usable PIN entry method', '2018', 1, '10-12', 'mjfvweawa', 'mhjvdhfvker'),
(5,'On overcoming the identified limitations of a usable PIN entry method', '2019', 2, '10-12', 'mjfvweawa', 'mhjvdhfvker'),
(6,'Text based Nlp search engine', '2020', 8, '10-12', 'mjfvweawa', 'mhjvdhfvker'),
(7,'Dispersion Ratio Based Decision Tree Model for Classification', '2020', 8, '10-12', 'mjfvweawa', 'mhjvdhfvker'),
(8,'ntelligent Scheduling of Thermostatic Devices for Efficient Energy Management in Smart Grid', '2020', 8, '10-12', 'mjfvweawa', 'mhjvdhfvker'),
(9,'Sensitivity- An Important Facet of Cluster Validation Process for Entity Matching Technique', '2020', 8, '10-12', 'mjfvweawa', 'mhjvdhfvker'),
(10,'Security Analysis of GTRBAC and its Variants using Model Checking', '2020', 8, '10-12', 'mjfvweawa', 'mhjvdhfvker'),
(11, 'Coordinated Scheduling of Residential Appliances and Heterogeneous Energy Sources in a Smart Microgrid', '2020', 8, '10-12','jhfa','wqf');
-- -------------------------------------------------------------------------------------------------------------
-- **Journal**
-- publication_id int(10), name varchar(100), volume int(10), issue_no int(10)

insert into journal
values
(1, 'journal1', 2, 3),
(2, 'journal2', 1, 13),
(3, 'journal3', 12, 4),
(4, 'journal4', 13, 6),
(7, 'journal7', 1, 61);
-- ----------------------------------------------------------------------------------------------------------------
-- **Conference***
-- publication_id int(10),name varchar(100), place varchar(30)

insert into conference
values
(11, 'confrnce6', 'YEh'),
(5, 'confrence5', 'TPTY'),
(8, 'confrence8', 'Delhi'),
(9, 'confrence9', 'Australia'),
(10, 'confrence10', 'UK'),
(6, 'confrence6', 'USA');
-- ----------------------------------------------------------------------------------------------------------

-- **consortina_partners**

insert into consortina_partners
values
(1,1),
(1,2),
(2,2),
(8,8);

-- ---------------------------------------------------------------------------------------------------
-- **sponsored_by**

insert into sponsored_by
values
(1,2,100000),
(2,1,100000),
(4,3,100000),
(2,2,100000),
(5,1,100000),
(6,2,100000),
(7,3,100000),
(7,4,100000),
(8,3,100000),
(9,7,100000),
(10,6,100000);


-- ---------------------------------------------------------------------------------------------------
-- **belongs_to**
insert into belongs_to
values
('1701CS53',1),
('1701CS54',1),
('1701CS22',1),
('1701CS23',1),
('1701CS15',1),
('FCS252',1),
('FME252',3),
('FME282', 3),
('1701ME19',3),
('1701ME22',3);

-- ---------------------------------------------------------------------------------------------------

-- ** has_tags_proj **
insert into has_tags_proj
values
(1,1),
(2,2),
(3,2),
(3,3),
(4,4),
(5,5),
(5,1),
(6,6),
(7,7),
(8,8),
(9,9),
(10,10);

-- ---------------------------------------------------------------------------------------------------

-- ** has_tags_pub **
insert into has_tags_pub
values
(1,1),
(2,2),
(3,2),
(3,3),
(4,4),
(5,5),
(5,1),
(6,6),
(7,7),
(8,8),
(9,9),
(10,10);
-- ---------------------------------------------------------------------------------------------------

-- ** affilliated_to **
insert into affilliated_to
values
("1701CS53",1),
("1701CS54",1),
("1701CS22",1),
("1701CS23",1),
('1701CS15',1),
('FCS252',1);


-- ---------------------------------------------------------------------------------------------------
-- **written_by**
insert into written_by
values
(3,'1701CS53',2),
(7,'1701CS53',2),
(10,'1701CS53',1),
(8,'1701CS53',2),
(6,'1701CS53',2),
(4,'1701CS54',2),
(2,'1701CS22',2),
(8,'1701CS22',2),
(6,'1701CS22',2),
(5,'1701CS22',2),
(9,'1701CS22',1),
(7,'1701CS22',2),
(1,'FCS252',1),
(5,'FCS252',1),
(8,'FCS252',1),
(6,'FCS252',1),
(1,'FME282',1),
(3,'FME282',1),
(2,'FME282',1),
(4,'FME282',1),
(11, 'FME282', 1);

-- ---------------------------------------------------------------------------------------------------

-- **done_by**
insert into done_by
values
(3,'1701CS53',2),
(7,'1701CS53',2),
(10,'1701CS53',1),
(8,'1701CS53',2),
(6,'1701CS53',2),
(4,'1701CS54',2),
(2,'1701CS22',2),
(8,'1701CS22',2),
(6,'1701CS22',2),
(5,'1701CS22',2),
(9,'1701CS22',1),
(7,'1701CS22',2),
(1,'FCS252',1),
(5,'FCS252',1),
(8,'FCS252',1),
(6,'FCS252',1),
(1,'FME282',1),
(3,'FME282',1),
(2,'FME282',1),
(4,'FME282',1);

-----------------------------------------------------------------------------------------------

