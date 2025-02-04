-- Conectar a la base de datos
\c mini_crm_db

-- Insertar reclutadores
insert into usuario (nombre, email, password, rol) values
('Ana Martínez', 'ana.martinez@example.com', 'hashed_password', 'reclutador'),
('Luis Fernández', 'luis.fernandez@example.com', 'hashed_password', 'reclutador'),
('María López', 'maria.lopez@example.com', 'hashed_password', 'reclutador');

-- Insertar candidatos
insert into usuario (nombre, email, password, rol) values
('Pedro Sánchez', 'pedro.sanchez@example.com', 'hashed_password', 'candidato'),
('Lucía Ramírez', 'lucia.ramirez@example.com', 'hashed_password', 'candidato'),
('Javier Torres', 'javier.torres@example.com', 'hashed_password', 'candidato');

-- Insertar vacantes
insert into vacante (titulo, descripcion, requisitos, reclutador_id) values
('Frontend Developer', 'React, Vue.js, experiencia en UI/UX', 'JavaScript, CSS, Tailwind', 
    (select usuario_id from usuario where email = 'ana.martinez@example.com')),
('Data Scientist', 'Machine Learning, análisis de datos', 'Python, SQL, TensorFlow', 
    (select usuario_id from usuario where email = 'luis.fernandez@example.com')),
('DevOps Engineer', 'Automatización y gestión de infraestructuras', 'Docker, Kubernetes, CI/CD',
    (select usuario_id from usuario where email = 'maria.lopez@example.com'));

-- Insertar aplicaciones de candidatos a vacantes
insert into aplicacion (candidato_id, vacante_id, cv_url) values
((select usuario_id from usuario where email = 'pedro.sanchez@example.com'),
 (select vacante_id from vacante where titulo = 'Frontend Developer'),
 'https://ejemplo.com/cvs/pedro_sanchez.pdf'),
 
((select usuario_id from usuario where email = 'lucia.ramirez@example.com'),
 (select vacante_id from vacante where titulo = 'Data Scientist'),
 'https://ejemplo.com/cvs/lucia_ramirez.pdf'),

((select usuario_id from usuario where email = 'javier.torres@example.com'),
 (select vacante_id from vacante where titulo = 'DevOps Engineer'),
 'https://ejemplo.com/cvs/javier_torres.pdf');

-- Consultar los datos poblados
select * from usuario;
select * from vacante;
select * from aplicacion;
