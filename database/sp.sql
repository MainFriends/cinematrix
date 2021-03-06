-- PROCEDIMIENTO ALMACENADO PARA EL REGISTRO DE USUARIOS
DELIMITER //
CREATE PROCEDURE SP_REGISTRO_USUARIO(
			IN	_NOMBRE VARCHAR(20),
				_APELLIDO VARCHAR(20),
                _CORREO VARCHAR(40),
                _CONTRASEÑA VARCHAR(50),
                _SEXO VARCHAR(10),
                _TELEFONO INT(20),
                _FECHA_NACIMIENTO DATE,
                _ID_PAIS INT,
                _CIUDAD VARCHAR(30)
)BEGIN
--  REGISTRO EN LA TABLA USUARIO
	SET @USER = (SELECT COUNT(CORREO) FROM USUARIO WHERE CORREO = _CORREO);
    IF @USER > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Correo existente';
    ELSE
    -- INSERTAMOS EN LA TABLA USUARIO
		INSERT INTO USUARIO(NOMBRE, APELLIDO, CORREO, SEXO, TELEFONO, FECHA_NACIMIENTO, ID_PAIS, CIUDAD)
        VALUES (_NOMBRE, _APELLIDO, _CORREO,  _SEXO, _TELEFONO, _FECHA_NACIMIENTO, _ID_PAIS, _CIUDAD);
    
    -- INSERTAMOS EN LA TABLA LOGIN
		SET @USERID = (SELECT MAX(ID_USUARIO) FROM USUARIO);
		INSERT INTO LOGIN(ID_USUARIO, ID_ROL, CORREO, CONTRASEÑA, FECHA_CREACION)
        VALUES(@USERID, 2, _CORREO, _CONTRASEÑA, NOW());
	END IF;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA EL INICIO DE SESIÓN
DELIMITER //
CREATE PROCEDURE SP_LOGIN_USUARIO(
			IN	_CORREO VARCHAR(40),
				_CONTRASEÑA VARCHAR(50)
)BEGIN
		SET lc_time_names = 'es_ES';
		SELECT USUARIO.ID_USUARIO, ID_ROL, NOMBRE, APELLIDO, USUARIO.CORREO, PAIS, CIUDAD, date_format(fecha_nacimiento, '%d de %M de %Y') FECHA_NACIMIENTO  FROM LOGIN, USUARIO, PAIS WHERE LOGIN.ID_USUARIO = USUARIO.ID_USUARIO
        AND USUARIO.ID_PAIS = PAIS.ID_PAIS
        AND LOGIN.CORREO = _CORREO AND LOGIN.CONTRASEÑA = _CONTRASEÑA;
END;
//

-- CRUD --
-- PROCEDIMIENTO ALMACENADO PARA AÑADIR UNA PELICULA
DELIMITER //
CREATE PROCEDURE SP_ADD_PELICULA(
			IN	_TITULO VARCHAR(30),
				_SINOPSIS TEXT,
				_DURACION TIME,
                _REPARTO VARCHAR(100),
                _DIRECTOR VARCHAR(100),
                _AÑO YEAR(4),
                _ID_CLASIFICACION INT,
                _ID_GENERO INT,
                _PORTADA VARCHAR(200),
                _ID_ESTADO INT
)BEGIN
		-- INSERTAMOS LA PELICULA
		INSERT INTO PELICULA(TITULO, SINOPSIS, DURACION, REPARTO, DIRECTOR, AÑO, ID_GENERO, ID_CLASIFICACION, PORTADA, ID_ESTADO)
        VALUES (_TITULO, _SINOPSIS, _DURACION, _REPARTO, _DIRECTOR, _AÑO, _ID_GENERO, _ID_CLASIFICACION, _PORTADA, _ID_ESTADO);
        
        -- CONSULTAMOS EL ULTIMO REGISTRO INGRESADO
		SELECT * FROM PELICULA ORDER BY ID_PELICULA DESC LIMIT 1;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA ACTUALIZAR PELICULA
DELIMITER //
CREATE PROCEDURE SP_UPD_PELICULA(
			IN	_ID_PELICULA INT,
				_TITULO VARCHAR(30),
				_SINOPSIS TEXT,
				_DURACION TIME,
                _REPARTO VARCHAR(100),
                _DIRECTOR VARCHAR(100),
                _AÑO YEAR(4),
                _ID_CLASIFICACION INT,
                _ID_GENERO INT,
                _PORTADA VARCHAR(200),
                _ID_ESTADO INT
)BEGIN
		-- ACTUALIZAMOS LOS CAMPOS DE LA PELICULA
		UPDATE PELICULA
        SET TITULO = _TITULO, SINOPSIS = _SINOPSIS, DURACION = _DURACION, REPARTO = _REPARTO, DIRECTOR = _DIRECTOR, AÑO = _AÑO, ID_GENERO = _ID_GENERO, ID_CLASIFICACION = _ID_CLASIFICACION, ID_ESTADO = _ID_ESTADO, PORTADA = _PORTADA
                            WHERE ID_PELICULA = _ID_PELICULA;
        
        -- EJECUTAMOS LA CONSULTA
        SELECT * FROM PELICULA WHERE ID_PELICULA = _ID_PELICULA;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA AÑADIR UNA SALA
DELIMITER //
CREATE PROCEDURE SP_ADD_SALA(
			IN	_NOMBRE VARCHAR(10),
				_DESCRIPCION VARCHAR(30),
                _CANT_ASIENTOS INT,
                _ID_ESTADO INT
)BEGIN
		-- INSERTAMOS LA SALA
		INSERT INTO SALA(NOMBRE, DESCRIPCION, CANT_ASIENTOS, ID_ESTADO)
        VALUES (_NOMBRE, _DESCRIPCION, _CANT_ASIENTOS, _ID_ESTADO);
        
        -- CONSULTAMOS EL ULTIMO REGISTRO INGRESADO
		SELECT * FROM SALA ORDER BY ID_SALA DESC LIMIT 1;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA ACTUALIZAR SALA
DELIMITER //
CREATE PROCEDURE SP_UPD_SALA(
			IN	_ID_SALA INT,
				_NOMBRE VARCHAR(10),
				_DESCRIPCION VARCHAR(30),
                _CANT_ASIENTOS INT,
                _ID_ESTADO INT
)BEGIN
		-- ACTUALIZAMOS LOS CAMPOS DE LA SALA
		UPDATE SALA
        SET NOMBRE = _NOMBRE, DESCRIPCION = _DESCRIPCION, CANT_ASIENTOS = _CANT_ASIENTOS, ID_ESTADO = _ID_ESTADO
                            WHERE ID_SALA = _ID_SALA;
        
        -- EJECUTAMOS LA CONSULTA
        SELECT * FROM SALA WHERE ID_SALA = _ID_SALA;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA AÑADIR UNA CARTELERA
DELIMITER //
CREATE PROCEDURE SP_ADD_CARTELERA(
			IN	_IDPELICULA INT,
				_IDSALA INT,
                _HORAINICIO TIME,
                _HORAFIN TIME,
                _IDIDIOMA INT,
                _IDFORMATO INT,
                _FECHA DATE
)BEGIN
		-- INSERTAMOS LA CARTELERA
		INSERT INTO CARTELERA(ID_PELICULA, ID_SALA, HORA_INICIO, HORA_FIN, ID_IDIOMA, ID_FORMATO, FECHA)
        VALUES (_IDPELICULA, _IDSALA, _HORAINICIO, _HORAFIN, _IDIDIOMA, _IDFORMATO, _FECHA);
        
        -- ACTUALIZAMOS EL ESTADO DE LA PELICULA
        UPDATE PELICULA
        SET ID_ESTADO = 8 -- EN CARTELERA
        WHERE ID_PELICULA = _IDPELICULA;

        -- CONSULTAMOS EL ULTIMO REGISTRO INGRESADO
		SELECT * FROM CARTELERA ORDER BY ID_CARTELERA DESC LIMIT 1;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA ACTUALIZAR CARTELERA
DELIMITER //
CREATE PROCEDURE SP_UPD_CARTELERA(
			IN	_IDCARTELERA INT,
				_IDPELICULA INT,
				_IDSALA INT,
                _HORAINICIO TIME,
                _HORAFIN TIME,
                _IDIDIOMA INT,
                _IDFORMATO INT,
                _FECHA DATE
)BEGIN
		-- ACTUALIZAMOS LOS CAMPOS DE LA CARTELERA
		UPDATE CARTELERA
        SET ID_PELICULA = _IDPELICULA, ID_SALA = _IDSALA, HORA_INICIO = _HORAINICIO, HORA_FIN = _HORAFIN, ID_IDIOMA = _IDIDIOMA, ID_FORMATO = _IDFORMATO, FECHA = _FECHA
                            WHERE ID_CARTELERA = _IDCARTELERA;                  
                            
        -- EJECUTAMOS LA CONSULTA
        SELECT * FROM CARTELERA WHERE ID_CARTELERA = _IDCARTELERA;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA AÑADIR UN NUEVO ASIENTO
DELIMITER //
CREATE PROCEDURE SP_ADD_ASIENTO(
			IN	_NUMASIENTO VARCHAR(5),
				_IDSALA INT,
                _IDESTADO INT
)BEGIN
		-- INSERTAMOS EL ASIENTO
		INSERT INTO ASIENTO(NUM_ASIENTO, ID_SALA, ID_ESTADO)
        VALUES (_NUMASIENTO, _IDSALA, _IDESTADO);
        
        -- CONSULTAMOS EL ULTIMO REGISTRO INGRESADO
		SELECT * FROM ASIENTO ORDER BY ID_ASIENTO DESC LIMIT 1;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA ACTUALIZAR ASIENTO
DELIMITER //
CREATE PROCEDURE SP_UPD_ASIENTO(
			IN	_IDASIENTO INT,
				_NUMASIENTO VARCHAR(5),
				_IDSALA INT,
                _IDESTADO INT
)BEGIN
		-- ACTUALIZAMOS LOS CAMPOS DEL ASIENTO
		UPDATE ASIENTO
        SET NUM_ASIENTO = _NUMASIENTO, ID_SALA = _IDSALA, ID_ESTADO = _IDESTADO
                            WHERE ID_ASIENTO = _IDASIENTO;
        
        -- EJECUTAMOS LA CONSULTA
        SELECT * FROM ASIENTO WHERE ID_ASIENTO = _IDASIENTO;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA AÑADIR UNA NUEVA PROMOCION
DELIMITER //
CREATE PROCEDURE SP_ADD_PROMO(
			IN	_NOMBRE VARCHAR(50),
				_DESCRIPCION TEXT,
                _IDCATEGORIA INT,
                _PRECIO DECIMAL(10,2),
                _IMAGEN VARCHAR(200)
)BEGIN
		-- INSERTAMOS LA PROMOCION
		INSERT INTO PROMOCION(NOMBRE, DESCRIPCION, ID_CATEGORIA, PRECIO, IMAGEN)
        VALUES (_NOMBRE, _DESCRIPCION, _IDCATEGORIA, _PRECIO, _IMAGEN);
        
        -- CONSULTAMOS EL ULTIMO REGISTRO INGRESADO
		SELECT * FROM PROMOCION ORDER BY ID_PROMO DESC LIMIT 1;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA ACTUALIZAR UNA PROMOCION
DELIMITER //
CREATE PROCEDURE SP_UPD_PROMO(
			IN	_IDPROMO INT,
				_NOMBRE VARCHAR(50),
				_DESCRIPCION TEXT,
                _IDCATEGORIA INT,
                _PRECIO DECIMAL(10,2),
                _IMAGEN VARCHAR(200)
)BEGIN
		-- ACTUALIZAMOS LOS CAMPOS DE LA PROMOCION
		UPDATE PROMOCION
        SET NOMBRE = _NOMBRE, DESCRIPCION = _DESCRIPCION, ID_CATEGORIA = _IDCATEGORIA, PRECIO = _PRECIO, IMAGEN = _IMAGEN
                            WHERE ID_PROMO = _IDPROMO;
        
        -- EJECUTAMOS LA CONSULTA
        SELECT * FROM PROMOCION WHERE ID_PROMO = _IDPROMO;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA AÑADIR UNA NUEVA PROGRAMACION
DELIMITER //
CREATE PROCEDURE SP_ADD_PPROMO(
			IN	_IDPROMO INT,
				_FECHAI DATE,
                _FECHAF DATE,
                _IDESTADO INT
)BEGIN
		-- INSERTAMOS LA PROGRAMACION
		INSERT INTO PROGRAMACION_PROMO(ID_PROMO, FECHA_INICIO, FECHA_FIN, ID_ESTADO)
        VALUES (_IDPROMO, _FECHAI, _FECHAF, _IDESTADO);
        
        -- CONSULTAMOS EL ULTIMO REGISTRO INGRESADO
		SELECT * FROM PROGRAMACION_PROMO ORDER BY ID_PPROMO DESC LIMIT 1;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA ACTUALIZAR UNA PROGRAMACION
DELIMITER //
CREATE PROCEDURE SP_UPD_PPROMO(
			IN	_IDPPROMO INT,
				_IDPROMO INT,
				_FECHAI DATE,
                _FECHAF DATE,
                _IDESTADO INT
)BEGIN
		-- ACTUALIZAMOS LOS CAMPOS DE LA PROGRAMACION
		UPDATE PROGRAMACION_PROMO
        SET ID_PROMO = _IDPROMO, FECHA_INICIO = _FECHAI, FECHA_FIN = _FECHAF, ID_ESTADO = _IDESTADO
                            WHERE ID_PPROMO = _IDPPROMO;
        
        -- EJECUTAMOS LA CONSULTA
        SELECT * FROM PROGRAMACION_PROMO WHERE ID_PPROMO = _IDPPROMO;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA EDITAR PERFIL
DELIMITER //
CREATE PROCEDURE SP_UPD_PERFIL(
			IN	_ID INT,
				_NOMBRE VARCHAR(20),
				_APELLIDO VARCHAR(20),
				_CORREO VARCHAR(40),
                _CIUDAD VARCHAR(30),
                _PAIS INT
)BEGIN
		-- ACTUALIZAMOS LOS CAMPOS DEL USUARIO
		UPDATE USUARIO
        SET NOMBRE = _NOMBRE, APELLIDO = _APELLIDO, CORREO = _CORREO, CIUDAD = _CIUDAD, ID_PAIS = _PAIS
                            WHERE ID_USUARIO = _ID;
                            
		UPDATE LOGIN
        SET CORREO = _CORREO
        WHERE ID_USUARIO = _ID;
                            
		SET lc_time_names = 'es_ES';
		SELECT USUARIO.ID_USUARIO, ID_ROL, NOMBRE, APELLIDO, USUARIO.CORREO, PAIS, CIUDAD, date_format(fecha_nacimiento, '%d de %M de %Y') FECHA_NACIMIENTO
        FROM LOGIN, USUARIO, PAIS WHERE LOGIN.ID_USUARIO = USUARIO.ID_USUARIO
        AND USUARIO.ID_PAIS = PAIS.ID_PAIS
        AND USUARIO.ID_USUARIO = _ID;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA ACTUALIZAR CONTRASEÑA
DELIMITER //
CREATE PROCEDURE SP_UPD_PASS(
			IN	_ID INT,
				_PASS VARCHAR(50),
                _NEWPASS VARCHAR(50)
)BEGIN
		SET @PASS = (SELECT CONTRASEÑA FROM LOGIN WHERE ID_USUARIO = _ID);
		-- ACTUALIZAMOS LA CONTRASEÑA
        IF @PASS = _PASS THEN
			UPDATE LOGIN
			SET CONTRASEÑA = _NEWPASS
			WHERE ID_USUARIO = _ID;
		ELSE
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'La contraseña ingresada es incorrecta';
        END IF;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA AÑADIR UN NUEVO BOLETO
DELIMITER //
CREATE PROCEDURE SP_ADD_BOLETO(
			IN	_NOMBRE VARCHAR(50),
				_DESCRIPCION TEXT,
                _PRECIO DECIMAL(10,2)
)BEGIN
		-- INSERTAMOS EL BOLETO
		INSERT INTO BOLETO(NOMBRE, DESCRIPCION, PRECIO)
        VALUES (_NOMBRE, _DESCRIPCION, _PRECIO);
        
        -- CONSULTAMOS EL ULTIMO REGISTRO INGRESADO
		SELECT * FROM BOLETO ORDER BY ID_BOLETO DESC LIMIT 1;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA ACTUALIZAR UN BOLETO
DELIMITER //
CREATE PROCEDURE SP_UPD_BOLETO(
			IN	_IDBOLETO INT,
				_NOMBRE VARCHAR(50),
				_DESCRIPCION TEXT,
                _PRECIO DECIMAL(10,2)
)BEGIN
		-- ACTUALIZAMOS LOS CAMPOS DEL BOLETO
		UPDATE BOLETO
        SET NOMBRE = _NOMBRE, DESCRIPCION = _DESCRIPCION, PRECIO = _PRECIO
                            WHERE ID_BOLETO = _IDBOLETO;
        
        -- EJECUTAMOS LA CONSULTA
        SELECT * FROM BOLETO WHERE ID_BOLETO = _IDBOLETO;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA AÑADIR UN NUEVO COMBO
DELIMITER //
CREATE PROCEDURE SP_ADD_COMBO(
			IN	_NOMBRE VARCHAR(50),
				_DESCRIPCION TEXT,
                _PRECIO DECIMAL(10,2),
                _IMAGEN VARCHAR(200)
)BEGIN
		-- INSERTAMOS EL COMBO
		INSERT INTO COMBO(NOMBRE, DESCRIPCION, PRECIO, IMAGEN)
        VALUES (_NOMBRE, _DESCRIPCION, _PRECIO, _IMAGEN);
        
        -- CONSULTAMOS EL ULTIMO REGISTRO INGRESADO
		SELECT * FROM COMBO ORDER BY ID_COMBO DESC LIMIT 1;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA ACTUALIZAR UN COMBO
DELIMITER //
CREATE PROCEDURE SP_UPD_COMBO(
			IN	_IDCOMBO INT,
				_NOMBRE VARCHAR(50),
				_DESCRIPCION TEXT,
                _PRECIO DECIMAL(10,2),
                _IMAGEN VARCHAR(200)
)BEGIN
		-- ACTUALIZAMOS LOS CAMPOS DEL COMBO
		UPDATE COMBO
        SET NOMBRE = _NOMBRE, DESCRIPCION = _DESCRIPCION, PRECIO = _PRECIO, IMAGEN = _IMAGEN
                            WHERE ID_COMBO = _IDCOMBO;
        
        -- EJECUTAMOS LA CONSULTA
        SELECT * FROM COMBO WHERE ID_COMBO = _IDCOMBO;
END;
//

-- PROCEDIMIENTO ALMACENADO PARA INSERTAR FACTURA
DELIMITER //
CREATE PROCEDURE SP_ADD_FACTURA(
			IN	_USERID INT,
				_SUBTOTAL DECIMAL(10,2),
				_TOTAL DECIMAL(10,2)
)BEGIN
		-- INSERTAMOS EN FACTURA
		INSERT INTO FACTURA(ID_USUARIO, FECHA, METODO_PAGO, PROMOCION, DESCUENTO, SUBTOTAL, TOTAL)
        VALUES(_USERID, NOW(), "Paypal", "NO", 0, _SUBTOTAL, _TOTAL);
END;
//

-- PROCEDIMIENTO ALMACENADO PARA INSERTAR DETALLE
DELIMITER //
CREATE PROCEDURE SP_ADD_DETALLE(
			IN	_USERID INT,
				_IDCARTELERA INT,
                _IDBOLETO INT,
                _IDCOMBO INT,
                _IDASIENTO VARCHAR(30)
)BEGIN	
		-- ASIGNAMOS LA FACTURA DEL USUARIO
		SET @FACTURA = (SELECT ID_FACTURA FROM FACTURA
					WHERE ID_USUARIO = _USERID
					ORDER BY ID_FACTURA DESC
					LIMIT 1);
                    
		SET @NUM_ASIENTO = (SELECT NUM_ASIENTO FROM ASIENTO WHERE ID_ASIENTO = _IDASIENTO);
                    
        IF _IDCOMBO = 0 THEN
            IF not exists(SELECT BUTACA FROM DETALLE WHERE BUTACA = @NUM_ASIENTO) THEN
				INSERT INTO DETALLE(ID_FACTURA, ID_CARTELERA, ID_BOLETO, ID_COMBO, BUTACA)
				VALUES (@FACTURA, _IDCARTELERA, _IDBOLETO, NULL, @NUM_ASIENTO);
                
                UPDATE ASIENTO
                SET ID_ESTADO = 2
                WHERE ID_ASIENTO = _IDASIENTO;
            END IF;
		ELSE
			INSERT INTO DETALLE(ID_FACTURA, ID_CARTELERA, ID_BOLETO, ID_COMBO, BUTACA)
			VALUES (@FACTURA, _IDCARTELERA, NULL, _IDCOMBO, NULL);
		END IF;
        
END;
//

-- PROCEDIMIENTO ALMACENADO PARA EL REGISTRO DE USUARIOS
DELIMITER //
CREATE PROCEDURE SP_REGISTRO_ADMINISTRADOR(
			IN	_NOMBRE VARCHAR(20),
				_APELLIDO VARCHAR(20),
                _CORREO VARCHAR(40),
                _CONTRASEÑA VARCHAR(50),
                _SEXO VARCHAR(10),
                _TELEFONO INT(20),
                _FECHA_NACIMIENTO DATE,
                _ID_PAIS INT,
                _CIUDAD VARCHAR(30)
)BEGIN
--  REGISTRO EN LA TABLA USUARIO
	SET @USER = (SELECT COUNT(CORREO) FROM USUARIO WHERE CORREO = _CORREO);
    IF @USER > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Correo existente';
    ELSE
    -- INSERTAMOS EN LA TABLA USUARIO
		INSERT INTO USUARIO(NOMBRE, APELLIDO, CORREO, SEXO, TELEFONO, FECHA_NACIMIENTO, ID_PAIS, CIUDAD)
        VALUES (_NOMBRE, _APELLIDO, _CORREO,  _SEXO, _TELEFONO, _FECHA_NACIMIENTO, _ID_PAIS, _CIUDAD);
    
    -- INSERTAMOS EN LA TABLA LOGIN
		SET @USERID = (SELECT MAX(ID_USUARIO) FROM USUARIO);
		INSERT INTO LOGIN(ID_USUARIO, ID_ROL, CORREO, CONTRASEÑA, FECHA_CREACION)
        VALUES(@USERID, 1, _CORREO, _CONTRASEÑA, NOW());
	END IF;
END;
//