-- Eliminar la base de datos si ya existe y crearla de nuevo
drop database if exists mini_crm_db;
create database mini_crm_db;

-- Conectar a la base de datos recién creada
-- \c mini_crm_db

-- Eliminar el esquema public si existe y recrearlo
drop schema if exists public cascade;
create schema public;

-- Crear el enum para los roles de usuario
create type user_role as enum ('candidato', 'reclutador');

-- Crear el enum para los estados de aplicación
create type application_status as enum ('en proceso', 'contratado', 'rechazado');

-- Tabla de usuarios (tanto candidatos como reclutadores)
create table usuario (
    usuario_id uuid primary key default gen_random_uuid(),
    nombre varchar (100) not null,
    email varchar (255) unique not null,
    password varchar (255) not null,
    rol user_role not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp
);

-- Tabla de vacantes
create table vacante (
    vacante_id uuid primary key default gen_random_uuid(),
    titulo varchar (255) not null,
    descripcion text not null,
    requisitos text not null,
    reclutador_id uuid not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    -- Clave foránea
    constraint fk_reclutador_id foreign key (reclutador_id)
        references usuario (usuario_id)
        on delete cascade
        on update cascade
);

-- Tabla de aplicaciones
create table aplicacion (
    aplicacion_id uuid primary key default gen_random_uuid(),
    candidato_id uuid not null,
    vacante_id uuid not null,
    cv_url varchar (255) not null,
    estado application_status not null default 'en proceso',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    -- Claves foráneas
    constraint fk_candidato_id foreign key (candidato_id)
        references usuario (usuario_id)
        on delete cascade
        on update cascade,
    constraint fk_vacante_id foreign key (vacante_id)
        references vacante (vacante_id)
        on delete cascade
        on update cascade
);