USE master
GO

IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = 'adoorei')
BEGIN
  CREATE DATABASE adoorei;
END;
GO