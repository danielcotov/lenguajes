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

UPDATE CLIENTES SET ID_PAIS=1, ID_PROVINCIA=1 WHERE ID_CLIENTE =3;

select * from clientes;
select * from provincias;
select * from PAISES;


CREATE OR REPLACE PROCEDURE LISTAR_CLIENTES(CUR OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CUR FOR SELECT C.ID_CLIENTE ID,
                C.NOMBRE NOMBRE,
                C.APELLIDO APELLIDO,
                C.DIRECCION DIRECCION,
                P.NOMBRE PROVINCIA,
                PA.NOMBRE PAIS,
                B.NOMBRE CANTON,
                C.CORREO CORREO,
                C.TELEFONO TELEFONO,
                C.GENERO GENERO,
                C.FECHA_NACIMIENTO FECHA_NACIMIENTO
                FROM CLIENTES C, CANTONES B, PROVINCIAS P, PAISES PA
                WHERE C.ID_CANTON=B.ID_CANTON AND B.ID_PROVINCIA = P.ID_PROVINCIA AND P.ID_PAIS = PA.ID_PAIS;
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


CREATE OR REPLACE PROCEDURE LISTAR_CLIENTE(VID IN NUMBER, NOMBRE OUT VARCHAR2,APELLIDO OUT VARCHAR2,DIRECCION OUT VARCHAR2,
                                            CANTON OUT VARCHAR2,PROVINCIA OUT VARCHAR2,
                                            PAIS OUT VARCHAR2,CORREO OUT VARCHAR2,
                                            TELEFONO OUT NUMBER,GENERO OUT CHAR,FECHA_NACIMIENTO OUT DATE)
AS
 CURSOR CLIENTES IS  SELECT C.ID_CLIENTE ID,
                            C.NOMBRE NOMBRE,
                            C.APELLIDO APELLIDO,
                            C.DIRECCION DIRECCION,
                            P.NOMBRE PROVINCIA,
                            PA.NOMBRE PAIS,
                            B.NOMBRE CANTON,
                            C.CORREO CORREO,
                            C.TELEFONO TELEFONO,
                            C.GENERO GENERO,
                            C.FECHA_NACIMIENTO FECHA_NACIMIENTO
                    FROM CLIENTES C,CANTONES B, PROVINCIAS P, PAISES PA
                    WHERE C.ID_CANTON = B.ID_CANTON AND
                    B.ID_PROVINCIA = P.ID_PROVINCIA AND
                    P.ID_PAIS = PA.ID_PAIS AND C.ID_CLIENTE = VID;
BEGIN
    FOR CUR IN CLIENTES
        LOOP
            NOMBRE := CUR.NOMBRE;
            APELLIDO := CUR.APELLIDO;
            DIRECCION := CUR.DIRECCION;
            PAIS := CUR.PAIS;
            PROVINCIA := CUR.PROVINCIA;
            CANTON := CUR.CANTON;
            CORREO := CUR.CORREO;
            TELEFONO := CUR.TELEFONO;
            GENERO := CUR.GENERO;
            FECHA_NACIMIENTO := CUR.FECHA_NACIMIENTO;
        END LOOP;
END;

CREATE OR REPLACE PROCEDURE INSERTAR_CLIENTE(VID IN NUMBER,VNOMBRE IN VARCHAR2,VAPELLIDO IN VARCHAR2,VDIRECCION IN VARCHAR2, 
                                            VCANTON IN VARCHAR2, VPROVINCIA IN VARCHAR2, VPAIS IN VARCHAR2, VCORREO IN VARCHAR2,  
                                            VTELEFONO IN NUMBER, VGENERO IN CHAR,VFECHA_NACIMIENTO IN DATE)
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

    INSERT INTO CLIENTES
    VALUES(VID,
    VNOMBRE,
    VAPELLIDO,
    VDIRECCION,
    OBTENER_ID_CANTON(VCANTON),
    VCORREO,
    VTELEFONO,
    VGENERO,
    VFECHA_NACIMIENTO);
    COMMIT;
END;

select * from cantones;

CREATE OR REPLACE PROCEDURE ACTUALIZAR_CLIENTE(VID IN NUMBER,VNOMBRE IN VARCHAR2,VAPELLIDO IN VARCHAR2,
                                            VDIRECCION IN VARCHAR2,VCANTON IN VARCHAR2, VPROVINCIA IN VARCHAR2, VPAIS IN VARCHAR2,
                                            VCORREO IN VARCHAR2,VTELEFONO IN NUMBER,VGENERO IN CHAR,VFECHA_NACIMIENTO IN DATE)
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

    UPDATE CLIENTES
    SET NOMBRE = VNOMBRE,
    APELLIDO = VAPELLIDO,
    DIRECCION = VDIRECCION,
    ID_CANTON = OBTENER_ID_CANTON(VCANTON),
    CORREO = VCORREO,
    TELEFONO = VTELEFONO,
    GENERO = VGENERO,
    FECHA_NACIMIENTO = VFECHA_NACIMIENTO
    WHERE ID_CLIENTE=VID;
    COMMIT;
END;


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
CREATE OR REPLACE PROCEDURE ACTUALIZAR_PRODUCTO(VID IN NUMBER,VNOMBRE IN VARCHAR2,VPRECIO IN VARCHAR2,VDESCRIPCION IN VARCHAR2, 
                                            VCANTIDAD IN VARCHAR2, VCATEGORIA IN VARCHAR2)
AS
    VCANT_CV NUMBER(6) :=CANTIDAD_CATEGORIAS + 1;
BEGIN
    INSERT INTO CATEGORIAS
    SELECT VCANT_CV,VCATEGORIA
    FROM DUAL 
    WHERE NOT EXISTS(SELECT * FROM CATEGORIAS
                     WHERE NOMBRE = VCATEGORIA);
    UPDATE PRODUCTOS
    SET NOMBRE = VNOMBRE,
    PRECIO_UNIT = VPRECIO,
    DESCRIPCION = VDESCRIPCION,
    CANTIDAD_INV = VCANTIDAD,
    ID_CATEGORIA = OBTENER_ID_CATEGORIA(VCATEGORIA)
    WHERE ID_PRODUCTO=VID;
    COMMIT;
END;

CREATE OR REPLACE FUNCTION OBTENER_ID_CATEGORIA(VCATEGORIA IN VARCHAR2)
RETURN NUMBER
AS
 VID NUMBER(6);

BEGIN
    SELECT ID_CATEGORIA
    INTO VID
    FROM CATEGORIAS
    WHERE NOMBRE = VCATEGORIA;
 RETURN VID;
END;


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
CREATE OR REPLACE PROCEDURE LISTAR_CATEGORIAS(CUR OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CUR FOR SELECT NOMBRE
                FROM CATEGORIAS;
END;

CREATE OR REPLACE FUNCTION CANTIDAD_CATEGORIAS
RETURN NUMBER
AS
 VCANTIDAD NUMBER(6);

BEGIN
    SELECT COUNT(*)
    INTO VCANTIDAD
    FROM CATEGORIAS;
 RETURN VCANTIDAD;
END;

CREATE OR REPLACE PROCEDURE INSERTAR_PRODUCTO(VID IN NUMBER,VNOMBRE IN VARCHAR2,VPRECIO IN VARCHAR2,VDESCRIPCION IN VARCHAR2, 
                                            VCANTIDAD IN VARCHAR2, VCATEGORIA IN VARCHAR2)
AS
    VCANT_CV NUMBER(6) :=CANTIDAD_CATEGORIAS + 1;
BEGIN

    INSERT INTO CATEGORIAS
    SELECT VCANT_CV,VCATEGORIA
    FROM DUAL 
    WHERE NOT EXISTS(SELECT * FROM CATEGORIAS
                     WHERE NOMBRE = VCATEGORIA);

    INSERT INTO PRODUCTOS
    VALUES(VID,
    VNOMBRE,
    VPRECIO,
    VDESCRIPCION,
    VCANTIDAD,
    OBTENER_ID_CATEGORIA(VCATEGORIA));
    COMMIT;
END;




CREATE OR REPLACE FUNCTION CANTIDAD_PRODUCTOS
RETURN NUMBER
AS
 VCANTIDAD NUMBER(6);

BEGIN
    SELECT COUNT(*)
    INTO VCANTIDAD
    FROM PRODUCTOS;
 RETURN VCANTIDAD;
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
    OBTENER_ID_CANTON(VCANTON),
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

CREATE OR REPLACE PROCEDURE LISTAR_CANTONES_CLIENTE(CUR OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CUR FOR SELECT NOMBRE
                FROM CANTONES;
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

INSERT INTO VENTAS
VALUES (1,1,1,'27-JUL-21',13,10000,1);
INSERT INTO VENTAS
VALUES (2,3,1,'27-JUL-21',13,25000,0);
INSERT INTO VENTAS
VALUES (3,2,2,'27-JUL-21',13,5000,1);
INSERT INTO VENTAS
VALUES (4,2,3,'27-JUL-21',13,17000,0);
INSERT INTO VENTAS
VALUES (5,1,3,'27-JUL-21',13,8000,1);


INSERT INTO DETALLE_VENTAS
VALUES (1,2,7,8700);
INSERT INTO DETALLE_VENTAS
VALUES (2,1,2,7750);
INSERT INTO DETALLE_VENTAS
VALUES (2,3,1,14000);
INSERT INTO DETALLE_VENTAS
VALUES (3,5,2,4350);
INSERT INTO DETALLE_VENTAS
VALUES (4,4,4,6250);
INSERT INTO DETALLE_VENTAS
VALUES (4,3,10,8540);
INSERT INTO DETALLE_VENTAS
VALUES (5,2,3,6960);

SELECT * FROM DETALLE_VENTAS;

CREATE OR REPLACE PROCEDURE PRODUCTOS_MAS_VENDIDOS (CUR OUT SYS_REFCURSOR, VFECHA IN DATE)
AS

BEGIN
    OPEN CUR FOR SELECT DV.CANTIDAD,P.NOMBRE, V.FECHA
                FROM DETALLE_VENTAS DV, PRODUCTOS P, VENTAS V
                WHERE DV.ID_PRODUCTO = P.ID_PRODUCTO
                AND DV.ID_VENTA = V.ID_VENTA
                AND V.FECHA = VFECHA
                ORDER BY CANTIDAD DESC
                FETCH FIRST 5 ROWS ONLY;
END;


CREATE OR REPLACE PROCEDURE EMPLEADOS_MAS_RECIENTES (CUR OUT SYS_REFCURSOR)
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
                 WHERE U.ID_CANTON=C.ID_CANTON AND C.ID_PROVINCIA = PV.ID_PROVINCIA
                 AND PV.ID_PAIS = PS.ID_PAIS
                 ORDER BY FECHA_INGRESO DESC
                 FETCH FIRST 3 ROWS ONLY;
END;



CREATE OR REPLACE PROCEDURE AUMENTAR_SALARIOS (CUR OUT SYS_REFCURSOR, PORCENTAJE IN NUMBER)
AS

BEGIN
    FOR C IN(SELECT ID_USUARIO FROM USUARIOS
                 WHERE TRUNC(MONTHS_BETWEEN(SYSDATE,FECHA_INGRESO)) > 60)    
    LOOP
        UPDATE USUARIOS
        SET SALARIO = SALARIO*(PORCENTAJE/100 + 1)
        WHERE ID_USUARIO=C.ID_USUARIO;
    END LOOP;
    COMMIT;  
    OPEN CUR FOR SELECT NOMBRE,APELLIDO,FECHA_INGRESO,SALARIO,TRUNC(SALARIO/(100+PORCENTAJE) * 100) "SALARIO ANTERIOR"
                 FROM USUARIOS
                 WHERE TRUNC(MONTHS_BETWEEN(SYSDATE,FECHA_INGRESO)) > 60;
    
END;

CREATE OR REPLACE FUNCTION CORTE_AGUINALDO
RETURN DATE
AS
 VCORTE DATE;
BEGIN
    SELECT TO_DATE('01-11-' || EXTRACT(YEAR FROM ADD_MONTHS(TRUNC(SYSDATE), 12 * 1 * -1)))
    INTO VCORTE
    FROM DUAL;
 RETURN VCORTE;
END;

select CORTE_AGUINALDO from dual;
CREATE OR REPLACE FUNCTION MESES_AGUINALDO(VID IN NUMBER)
RETURN NUMBER
AS
 VMESES NUMBER(6);
BEGIN
    SELECT TRUNC(MONTHS_BETWEEN(SYSDATE,FECHA_INGRESO)) 
    INTO VMESES
    FROM USUARIOS
    WHERE ID_USUARIO = VID;
    
    IF VMESES > 12 THEN
        SELECT TRUNC(MONTHS_BETWEEN(SYSDATE,CORTE_AGUINALDO)) 
        INTO VMESES
        FROM USUARIOS
        WHERE ID_USUARIO = VID;
    END IF;
    
 RETURN VMESES;
END;

CREATE TABLE AGUINALDOS(ID NUMBER(6), NOMBRE VARCHAR2(25), APELLIDO VARCHAR2(25), FECHA_INGRESO DATE, SALARIO NUMBER(6), AGUINALDO NUMBER(6));

CREATE OR REPLACE PROCEDURE CALCULAR_AGUINALDOS (CUR OUT SYS_REFCURSOR)
AS
 VMESES NUMBER(6);
 VTABLA VARCHAR2(100);
BEGIN
    EXECUTE IMMEDIATE 'TRUNCATE TABLE AGUINALDOS';
    FOR C IN(SELECT ID_USUARIO, NOMBRE, APELLIDO, FECHA_INGRESO,SALARIO FROM USUARIOS)    
    LOOP
        VMESES := MESES_AGUINALDO(C.ID_USUARIO);
        INSERT INTO AGUINALDOS VALUES(C.ID_USUARIO, C.NOMBRE, C.APELLIDO, C.FECHA_INGRESO, C.SALARIO, C.SALARIO*VMESES/12);
    END LOOP;
    
    OPEN CUR FOR SELECT NOMBRE,APELLIDO,FECHA_INGRESO,SALARIO,AGUINALDO FROM AGUINALDOS;
END;
EXEC CALCULAR_AGUINALDOS;

SELECT MESES_AGUINALDO(1) FROM DUAL;

CREATE OR REPLACE PROCEDURE ELIMINAR_USUARIO(VID IN NUMBER)
AS
BEGIN
    DELETE FROM USUARIOS
    WHERE ID_USUARIO = VID;
    COMMIT;
END;

--./LDLIB/exp export/export FILE='/home/oracle/exports/gadafa.dmp' LOG='/home/oracle/exports/gadafa.txt' OWNER=GADAFA
