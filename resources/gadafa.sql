ALTER SESSION SET "_ORACLE_SCRIPT" = TRUE;

CREATE USER GADAFA IDENTIFIED BY gadafa
DEFAULT TABLESPACE USERS;
GRANT RESOURCE,CONNECT TO GADAFA;
ALTER USER GADAFA QUOTA UNLIMITED ON USERS;
ALTER USER GADAFA IDENTIFIED BY gadafa;
--./LDLIB/imp export/export FILE='C:\Users\josga\Desktop\gadafa.dmp' LOG='C:\Users\josga\Desktop\gadafa.txt' FROMUSER=gadafa TOUSER=gadafa


SET SERVEROUTPUT ON;
SET VERIFY OFF;


DROP USER GADAFA CASCADE;

CREATE OR REPLACE PROCEDURE INICIO_SESION(USUARIO IN VARCHAR2, CONTRASENA IN VARCHAR2, ESVALIDO OUT NUMBER)
AS
 CURSOR USUARIOS IS SELECT CORREO,PASSWORD
                    FROM USUARIOS;
BEGIN
    FOR CUR IN USUARIOS
        LOOP
            IF (CUR.CORREO = USUARIO AND CUR.PASSWORD = CONTRASENA) THEN
                ESVALIDO:=1;
                EXIT;
            ELSE
                ESVALIDO:=0;
            END IF;    
        END LOOP;
END;



--PAISES

INSERT INTO PAISES VALUES(1,'COSTA RICA');

--PROVINCIAS
INSERT INTO PROVINCIAS VALUES(1,'SAN JOSE', 1);

--CANTONES
INSERT INTO CANTONES VALUES(1,'CENTRAL', 1);

--CLIENTES
INSERT INTO CLIENTES VALUES(1,'Carlos','Torres','Barrio Mercedes',1,'ctorres@mail.com','90909090','M','19/JAN/1997');
INSERT INTO CLIENTES VALUES(2,'Claudia','Poll','Barrio Chepe',1,'cpoll@mail.com','80808080','F','19/JAN/1997');
INSERT INTO CLIENTES VALUES(3,'Keylor','Navas','Barrio Belen',1,'knavas@mail.com','70707070','M','19/JAN/1997');
INSERT INTO CLIENTES VALUES(4,'Will','Smith','La Yunai',1,'wsmith@mail.com','89876764','M','20/DEC/1981');

select * from clientes;

CREATE OR REPLACE PROCEDURE LISTAR_CLIENTES(CUR OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CUR FOR SELECT C.ID_CLIENTE ID,
                C.NOMBRE NOMBRE,
                C.APELLIDO APELLIDO,
                C.DIRECCION || ' ' ||
                B.NOMBRE DIRECCION,
                C.CORREO CORREO,
                C.TELEFONO TELEFONO,
                C.GENERO GENERO,
                C.FECHA_NACIMIENTO FECHA_NACIMIENTO
                FROM CLIENTES C, CANTONES B
                WHERE C.ID_CANTON=B.ID_CANTON;
END;

CREATE OR REPLACE FUNCTION CANTIDAD_CLIENTES
RETURN NUMBER
AS
 VCANTIDAD NUMBER(6);
 
BEGIN
    SELECT COUNT(*)
    INTO VCANTIDAD
    FROM CLIENTES;
 RETURN VCANTIDAD;
END;

select CANTIDAD_CLIENTES from dual;


--CATEGORIAS
INSERT INTO CATEGORIAS VALUES(1, 'Lacteos');
INSERT INTO CATEGORIAS VALUES(2, 'Carnes Rojas');
INSERT INTO CATEGORIAS VALUES(3, 'Carnes Blancas');
INSERT INTO CATEGORIAS VALUES(4, 'Verduras');
INSERT INTO CATEGORIAS VALUES(5, 'Frutas');

SELECT * FROM CATEGORIAS;

--PRODUCTOS
INSERT INTO PRODUCTOS VALUES(1, 'Chuleta', 2500, 'Kilo de Chuleta Ahumada', 89,2);
INSERT INTO PRODUCTOS VALUES(2, 'Leche', 900, 'Litro de leche', 150,1);
INSERT INTO PRODUCTOS VALUES(3, 'Pechuga Pollo', 1300, 'Pechuga de Pollo', 120,3);
INSERT INTO PRODUCTOS VALUES(4, 'Papa', 900,'Kilo de Papas', 200,4);
INSERT INTO PRODUCTOS VALUES(5, 'Fresa', 1200, 'Canasta de Fresas', 97,5);

SELECT * FROM PRODUCTOS;

CREATE OR REPLACE PROCEDURE LISTAR_PRODUCTOS(CUR OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CUR FOR SELECT P.ID_PRODUCTO ID,
                P.NOMBRE NOMBRE,
                P.PRECIO_UNIT PRECIO,
                P.DESCRIPCION DESCRIPCION,
                P.CANTIDAD_INV CANTIDAD,
                C.NOMBRE CATEGORIA
                FROM PRODUCTOS P, CATEGORIAS C
                WHERE P.ID_CATEGORIA=C.ID_CATEGORIA;
END;


--USUARIOS

INSERT INTO USUARIOS VALUES(1,'test','Fabian','Bolanos','Dir',1,'fabian',1234,'M','19/JAN/1997','19/APR/2007',100);
INSERT INTO USUARIOS VALUES(2,'test','Daniel','Coto','Dir',1,'daniel',1234,'M','24/JAN/1993','19/APR/2007',100);
INSERT INTO USUARIOS VALUES(3,'test','Gabriel','Duarte','Dir',1,'gabriel',1234,'M','19/JAN/1997','19/APR/2007',100);


CREATE OR REPLACE PROCEDURE LISTAR_USUARIOS(CUR OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CUR FOR SELECT U.ID_USUARIO ID,
                U.NOMBRE NOMBRE,
                U.APELLIDO APELLIDO,
                U.CORREO CORREO,
                U.TELEFONO TELEFONO,
                U.DIRECCION DIRECCION,
                U.GENERO GENERO,
                U.FECHA_NACIMIENTO FECHA_NACIMIENTO,
                U.FECHA_INGRESO FECHA_INGRESO,
                U.SALARIO SALARIO,
                C.NOMBRE CANTON,
                PV.NOMBRE PROVINCIA,
                PS.NOMBRE PAIS 
                FROM USUARIOS U, CANTONES C, PROVINCIAS PV, PAISES PS
                WHERE U.ID_CANTON=C.ID_CANTON AND C.ID_PROVINCIA = PV.ID_PROVINCIA AND PV.ID_PAIS = PS.ID_PAIS;
END;

CREATE OR REPLACE PROCEDURE LISTAR_USUARIO(VID IN NUMBER, NOMBRE OUT VARCHAR2,APELLIDO OUT VARCHAR2,CORREO OUT VARCHAR2,
                                            CONTRASENA OUT VARCHAR2, TELEFONO OUT NUMBER,DIRECCION OUT VARCHAR2, CANTON OUT VARCHAR2,
                                            PROVINCIA OUT VARCHAR2,PAIS OUT VARCHAR2,GENERO OUT CHAR,FECHA_NACIMIENTO OUT DATE,
                                            FECHA_INGRESO OUT DATE,SALARIO OUT NUMBER)
AS
 CURSOR USUARIOS IS  SELECT U.ID_USUARIO ID,
                            U.NOMBRE NOMBRE,
                            U.APELLIDO APELLIDO,
                            U.CORREO CORREO,
                            U.PASSWORD CONTRASENA,
                            U.TELEFONO TELEFONO,
                            U.DIRECCION DIRECCION,
                            U.GENERO GENERO,
                            U.FECHA_NACIMIENTO FECHA_NACIMIENTO,
                            U.FECHA_INGRESO FECHA_INGRESO,
                            U.SALARIO SALARIO,
                            C.NOMBRE CANTON,
                            PV.NOMBRE PROVINCIA,
                            PS.NOMBRE PAIS
                    FROM USUARIOS U,CANTONES C,PROVINCIAS PV,PAISES PS
                    WHERE U.ID_CANTON = C.ID_CANTON AND C.ID_PROVINCIA = PV.ID_PROVINCIA 
                    AND PV.ID_PAIS = PS.ID_PAIS AND U.ID_USUARIO = VID;
BEGIN
    FOR CUR IN USUARIOS
        LOOP
            NOMBRE := CUR.NOMBRE;
            APELLIDO := CUR.APELLIDO;
            CORREO := CUR.CORREO;
            CONTRASENA := CUR.CONTRASENA;
            TELEFONO := CUR.TELEFONO;
            DIRECCION := CUR.DIRECCION;
            CANTON := CUR.CANTON;
            PROVINCIA := CUR.PROVINCIA;
            PAIS := CUR.PAIS;
            GENERO := CUR.GENERO;
            FECHA_NACIMIENTO := CUR.FECHA_NACIMIENTO;
            FECHA_INGRESO := CUR.FECHA_INGRESO;
            SALARIO := CUR.SALARIO;
        END LOOP;
END;


CREATE OR REPLACE PROCEDURE ACTUALIZAR_USUARIO(VID IN NUMBER,VNOMBRE IN VARCHAR2,VAPELLIDO IN VARCHAR2,VCORREO IN VARCHAR2,
                                            VCONTRASENA IN VARCHAR2, VTELEFONO IN NUMBER,VDIRECCION IN VARCHAR2,
                                            VCANTON IN VARCHAR2, VPROVINCIA IN VARCHAR2, VPAIS IN VARCHAR2, VGENERO IN CHAR,
                                            VFECHA_NACIMIENTO IN DATE,VFECHA_INGRESO IN DATE, VSALARIO IN NUMBER)
AS
    VCANT_PV NUMBER(6) :=CANTIDAD_PROVINCIAS + 1;
    VCANT_C NUMBER(6) :=CANTIDAD_CANTONES + 1;
    VCANT_PS NUMBER(6) :=CANTIDAD_PAISES + 1;
BEGIN
    INSERT INTO PAISES
    SELECT VCANT_PS,VPAIS
    FROM DUAL 
    WHERE NOT EXISTS(SELECT 2 FROM PAISES
                     WHERE NOMBRE = VPAIS);
    INSERT INTO PROVINCIAS
    SELECT VCANT_PV,VPROVINCIA,OBTENER_ID_PAIS(VPAIS)
    FROM DUAL 
    WHERE NOT EXISTS(SELECT * FROM PROVINCIAS
                     WHERE NOMBRE = VPROVINCIA);
                     
    INSERT INTO CANTONES
    SELECT VCANT_C,VCANTON,OBTENER_ID_PROVINCIA(VPROVINCIA)
    FROM DUAL 
    WHERE NOT EXISTS(SELECT NOMBRE FROM CANTONES
                     WHERE NOMBRE = VCANTON);  
                     
    UPDATE USUARIOS
    SET NOMBRE = VNOMBRE,
    APELLIDO = VAPELLIDO,
    CORREO = VCORREO,
    PASSWORD = VCONTRASENA,
    TELEFONO = VTELEFONO,
    DIRECCION = VDIRECCION,
    ID_CANTON = OBTENER_ID_CANTON(VCANTON),
    GENERO = VGENERO,
    FECHA_NACIMIENTO = VFECHA_NACIMIENTO,
    FECHA_INGRESO = VFECHA_INGRESO,
    SALARIO = VSALARIO
    WHERE ID_USUARIO=VID;
    COMMIT;
END;

CREATE OR REPLACE FUNCTION CANTIDAD_USUARIOS
RETURN NUMBER
AS
 VCANTIDAD NUMBER(6);
 
BEGIN
    SELECT COUNT(*)
    INTO VCANTIDAD
    FROM USUARIOS;
 RETURN VCANTIDAD;
END;

CREATE OR REPLACE FUNCTION CANTIDAD_PROVINCIAS
RETURN NUMBER
AS
 VCANTIDAD NUMBER(6);
 
BEGIN
    SELECT COUNT(*)
    INTO VCANTIDAD
    FROM PROVINCIAS;
 RETURN VCANTIDAD;
END;

CREATE OR REPLACE FUNCTION CANTIDAD_CANTONES
RETURN NUMBER
AS
 VCANTIDAD NUMBER(6);
 
BEGIN
    SELECT COUNT(*)
    INTO VCANTIDAD
    FROM CANTONES;
 RETURN VCANTIDAD;
END;

CREATE OR REPLACE FUNCTION CANTIDAD_PAISES
RETURN NUMBER
AS
 VCANTIDAD NUMBER(6);
 
BEGIN
    SELECT COUNT(*)
    INTO VCANTIDAD
    FROM PAISES;
 RETURN VCANTIDAD;
END;

CREATE OR REPLACE PROCEDURE INSERTAR_USUARIO(VID IN NUMBER,VNOMBRE IN VARCHAR2,VAPELLIDO IN VARCHAR2,VCORREO IN VARCHAR2,
                                            VCONTRASENA IN VARCHAR2, VTELEFONO IN NUMBER,VDIRECCION IN VARCHAR2,
                                            VCANTON IN VARCHAR2, VPROVINCIA IN VARCHAR2, VPAIS IN VARCHAR2, VGENERO IN CHAR,
                                            VFECHA_NACIMIENTO IN DATE,VFECHA_INGRESO IN DATE, VSALARIO IN NUMBER)
AS
    VCANT_PV NUMBER(6) :=CANTIDAD_PROVINCIAS + 1;
    VCANT_C NUMBER(6) :=CANTIDAD_CANTONES + 1;
    VCANT_PS NUMBER(6) :=CANTIDAD_PAISES + 1;
BEGIN
    
    INSERT INTO PAISES
    SELECT VCANT_PS,VPAIS
    FROM DUAL 
    WHERE NOT EXISTS(SELECT 2 FROM PAISES
                     WHERE NOMBRE = VPAIS);
    INSERT INTO PROVINCIAS
    SELECT VCANT_PV,VPROVINCIA,OBTENER_ID_PAIS(VPAIS)
    FROM DUAL 
    WHERE NOT EXISTS(SELECT * FROM PROVINCIAS
                     WHERE NOMBRE = VPROVINCIA);

    INSERT INTO CANTONES
    SELECT VCANT_C,VCANTON,OBTENER_ID_PROVINCIA(VPROVINCIA)
    FROM DUAL 
    WHERE NOT EXISTS(SELECT NOMBRE FROM CANTONES
                     WHERE NOMBRE = VCANTON);  
     
    INSERT INTO USUARIOS
    VALUES(VID,
    VCONTRASENA,
    VNOMBRE,
    VAPELLIDO,
    VDIRECCION,
    CANTIDAD_CANTONES,
    VCORREO,
    VTELEFONO,
    VGENERO,
    VFECHA_NACIMIENTO,
    VFECHA_INGRESO,
    VSALARIO);
    COMMIT;
END;

CREATE OR REPLACE PROCEDURE LISTAR_PAISES(CUR OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CUR FOR SELECT NOMBRE
                FROM PAISES;
END;

CREATE OR REPLACE PROCEDURE LISTAR_PROVINCIAS(CUR OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CUR FOR SELECT NOMBRE
                FROM PROVINCIAS;
END;

CREATE OR REPLACE PROCEDURE LISTAR_PROVINCIAS(CUR OUT SYS_REFCURSOR, VPAIS IN VARCHAR2)
AS
BEGIN
    OPEN CUR FOR SELECT NOMBRE
                FROM PROVINCIAS
                WHERE ID_PAIS = OBTENER_ID_PAIS(VPAIS);
END;

CREATE OR REPLACE PROCEDURE LISTAR_CANTONES(CUR OUT SYS_REFCURSOR, VPROVINCIA IN VARCHAR2)
AS
BEGIN
    OPEN CUR FOR SELECT NOMBRE
                FROM CANTONES
                WHERE ID_PROVINCIA = OBTENER_ID_PROVINCIA(VPROVINCIA);
END;

CREATE OR REPLACE PROCEDURE TEST1(VPAIS IN VARCHAR2, VPROVINCIA IN VARCHAR2,VCANTON IN VARCHAR2)
AS
    VCANT_PV NUMBER(6) :=CANTIDAD_PROVINCIAS + 1;
    VCANT_C NUMBER(6) :=CANTIDAD_CANTONES + 1;
    VCANT_PS NUMBER(6) :=CANTIDAD_PAISES + 1;
BEGIN
    INSERT INTO PAISES
    SELECT VCANT_PS,VPAIS
    FROM DUAL 
    WHERE NOT EXISTS(SELECT 2 FROM PAISES
                     WHERE NOMBRE = VPAIS);
    INSERT INTO PROVINCIAS
    SELECT VCANT_PV,VPROVINCIA,OBTENER_ID_PAIS(VPAIS)
    FROM DUAL 
    WHERE NOT EXISTS(SELECT * FROM PROVINCIAS
                     WHERE NOMBRE = VPROVINCIA);

    INSERT INTO CANTONES
    SELECT VCANT_C,VCANTON,OBTENER_ID_PROVINCIA(VPROVINCIA)
    FROM DUAL 
    WHERE NOT EXISTS(SELECT NOMBRE FROM CANTONES
                     WHERE NOMBRE = VCANTON);                 
END;

EXECUTE TEST1('GERMANY', 'MUNICH','DOWNTOWN2');

SELECT * FROM CANTONES;
SELECT * FROM PROVINCIAS;
SELECT * FROM PAISES;

delete from cantones where id_canton=3;
select OBTENER_ID_PROVINCIA('SAN JOSE') from DUAL;

CREATE OR REPLACE FUNCTION OBTENER_ID_PROVINCIA(VPROVINCIA IN VARCHAR2)
RETURN NUMBER
AS
 VID NUMBER(6);
 
BEGIN
    SELECT ID_PROVINCIA
    INTO VID
    FROM PROVINCIAS
    WHERE NOMBRE = VPROVINCIA;
 RETURN VID;
END;

CREATE OR REPLACE FUNCTION OBTENER_ID_PAIS(VPAIS IN VARCHAR2)
RETURN NUMBER
AS
 VID NUMBER(6);
 
BEGIN
    SELECT ID_PAIS
    INTO VID
    FROM PAISES
    WHERE NOMBRE = VPAIS;
 RETURN VID;
END;

CREATE OR REPLACE FUNCTION OBTENER_ID_CANTON(VCANTON IN VARCHAR2)
RETURN NUMBER
AS
 VID NUMBER(6);
 
BEGIN
    SELECT ID_CANTON
    INTO VID
    FROM CANTONES
    WHERE NOMBRE = VCANTON;
 RETURN VID;
END;


--./LDLIB/exp export/export FILE='/home/oracle/exports/gadafa.dmp' LOG='/home/oracle/exports/gadafa.txt' OWNER=GADAFA
