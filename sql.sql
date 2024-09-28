INSERT INTO gs_an_table(id,date,prefecture,companion,memory,indate)VALUES(NULL,'2012/1/1','東京都','test','test内容',sysdate());

INSERT INTO gs_an_table(id,date,prefecture,companion,memory,indate)VALUES(NULL,'2012/5/1','大阪府','test2','test内容2',sysdate());

INSERT INTO gs_an_table(date,prefecture,companion,memory,indate)VALUES(:date,:prefecture,:companion,:memory,sysdate());
