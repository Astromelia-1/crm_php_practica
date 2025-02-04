-- Conectar a la base de datos
-- \c mini_crm_db

-- Verificar los valores de los enums
select unnest(enum_range(null::user_role));
select unnest(enum_range(null::application_status));

-- Insertar un reclutador
insert into usuario (nombre, email, password, rol)
values ('Juan Pérez', 'juan.perez@example.com', 'hashed_password', 'reclutador')
returning usuario_id;

-- Insertar un candidato
insert into usuario (nombre, email, password, rol)
values ('Carlos Gómez', 'carlos.gomez@example.com', 'hashed_password', 'candidato')
returning usuario_id;

-- Insertar una vacante creada por el reclutador
insert into vacante (titulo, descripcion, requisitos, reclutador_id)
values ('Desarrollador Backend', 'Trabajo remoto en Laravel', 'Experiencia en PHP y PostgreSQL', 
       (select usuario_id from usuario where email = 'juan.perez@example.com'))
returning vacante_id;

-- Insertar una aplicación del candidato a la vacante
insert into aplicacion (candidato_id, vacante_id, cv_url)
values (
    (select usuario_id from usuario where email = 'carlos.gomez@example.com'),
    (select vacante_id from vacante where titulo = 'Desarrollador Backend'),
    'https://ejemplo.com/cvs/carlos_gomez.pdf'
)
returning aplicacion_id;

-- Consultar la relación de candidatos y vacantes
select u.nombre as candidato, v.titulo as vacante, a.estado
from aplicacion a
join usuario u on a.candidato_id = u.usuario_id
join vacante v on a.vacante_id = v.vacante_id;

-- Actualizar estado de una aplicación
update aplicacion
set estado = 'contratado'
where aplicacion_id = (select aplicacion_id from aplicacion limit 1);

-- Eliminar un candidato (debe eliminar su aplicación)
delete from usuario where email = 'carlos.gomez@example.com';

-- Consultar nuevamente las aplicaciones
select * from aplicacion;
