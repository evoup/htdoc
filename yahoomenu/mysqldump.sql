#This an cample of build Yahoo UI menu from database
#----- MySQL DUMP table structure and sample data---------cut here
USE test;

# Table structure for table 'h_meny'

CREATE TABLE IF NOT EXISTS h_meny (
  id tinyint(3) NOT NULL auto_increment,
  level int(2) ,
  point varchar(30) ,
  link varchar(30) ,
  hint varchar(40) ,
  sublevel varchar(30) ,
  PRIMARY KEY (id)
);


# Dumping data for table 'h_meny'

INSERT INTO h_meny VALUES("1","1","level one item 1","#","it's a hint","0");
INSERT INTO h_meny VALUES("2","1","level one item 2","#","it's a hint","0");
INSERT INTO h_meny VALUES("3","2","level 2 item 1","#","it's a hint","1");
INSERT INTO h_meny VALUES("4","2","level 2 item 1","#","it's a hint","2");
INSERT INTO h_meny VALUES("5","2","level 2 item 2","#","it's a hint","1");
INSERT INTO h_meny VALUES("6","2","level 3 item 1","#","it's a hint","4");

#----- MySQL DUMP table structure and sample data---------end cut