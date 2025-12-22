# Esquema de Base de Datos - SIGP

## Diagrama Entidad-Relación

```mermaid
erDiagram
    USUARIOS {
        int id PK
        string nombre
        string email
        string password
        int role_id FK
    }

    ROLES {
        int id PK
        string nombre
    }

    PERFIL_ESTUDIANTES {
        int id PK
        int user_id FK
        string dui
        string telefono
        string departamento
        string genero
        int carrera_id FK
    }

    EMPRESAS {
        int id PK
        int user_id FK
        string nombre_comercial
        string rubro
    }

    PLAZAS {
        int id PK
        int empresa_id FK
        string titulo
        string descripcion
        string estado
    }

    POSTULACIONES {
        int id PK
        int plaza_id FK
        int estudiante_id FK
        string estado "pendiente, aceptado, rechazado"
        datetime fecha_postulacion
    }

    USUARIOS ||--|| PERFIL_ESTUDIANTES : "tiene"
    USUARIOS ||--|| EMPRESAS : "administra"
    USUARIOS }|--|| ROLES : "asignado a"
    EMPRESAS ||--|{ PLAZAS : "publica"
    PLAZAS ||--|{ POSTULACIONES : "recibe"
    PERFIL_ESTUDIANTES ||--|{ POSTULACIONES : "realiza"
```

## Relaciones Clave

1.  **Autenticación Centralizada**: La tabla `usuarios` gestiona el acceso para todos los roles, diferenciándose por `role_id`.
2.  **Perfiles Extendidos**: Dependiendo del rol, se extiende la información en `perfil_estudiantes` o `empresas`.
3.  **Ciclo de Postulación**: Relación muchos a muchos entre estudiantes y plazas a través de `postulaciones`.
