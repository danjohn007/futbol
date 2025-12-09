# Guía de Pruebas - Funcionalidades de Gestión de Equipos y Torneos

## Pre-requisitos

1. Base de datos MySQL configurada y funcionando
2. Tablas creadas según `database/schema.sql`
3. Datos de ejemplo cargados desde `database/sample_data.sql`
4. Usuario con rol DELEGADO, ORGANIZADOR o SUPERADMIN

## Escenarios de Prueba

### Escenario 1: Inscribir Equipo a un Torneo

**Como:** Delegado o Organizador  
**Quiero:** Inscribir mi equipo a un torneo  
**Para:** Participar en la competición

#### Pasos:
1. Iniciar sesión con usuario delegado o organizador
2. Navegar a **Torneos** desde el menú lateral
3. Seleccionar un torneo en estado "INSCRIPCIONES"
4. Hacer clic en el botón **"Inscribir Equipo"** (azul, esquina superior derecha)
5. Seleccionar un equipo del dropdown
6. (Opcional) Ingresar un grupo (A, B, C, etc.)
7. Hacer clic en **"Inscribir Equipo"**

#### Resultado Esperado:
- ✅ Mensaje de éxito: "Equipo inscrito exitosamente"
- ✅ Redirige a la vista detalle del torneo
- ✅ El equipo aparece en la sección "Equipos Inscritos"
- ✅ Muestra logo del equipo, nombre, grupo y estado "APROBADO"

#### Validaciones a Verificar:
- ❌ No se puede inscribir el mismo equipo dos veces
- ❌ Solo se pueden inscribir equipos a torneos en estado "INSCRIPCIONES"
- ❌ Delegados solo ven sus propios equipos en el dropdown
- ❌ No aparecen equipos ya inscritos en el dropdown

---

### Escenario 2: Agregar Jugador a un Equipo

**Como:** Delegado o Superadmin  
**Quiero:** Agregar un nuevo jugador a mi equipo  
**Para:** Completar la plantilla del equipo

#### Pasos:
1. Iniciar sesión con usuario delegado (o superadmin)
2. Navegar a **Equipos** desde el menú lateral
3. Seleccionar un equipo (propio si eres delegado)
4. En la sección "Acciones", hacer clic en **"Agregar Jugador"**
5. Completar el formulario:
   - **Nombre:** Juan
   - **Apellidos:** Pérez García
   - **Fecha de Nacimiento:** 01/01/2000
   - **Número de Camisa:** 10
   - **Posición:** Mediocampista
6. Hacer clic en **"Agregar Jugador"**

#### Resultado Esperado:
- ✅ Mensaje de éxito: "Jugador agregado exitosamente"
- ✅ Redirige a la vista detalle del equipo
- ✅ El jugador aparece en la sección "Plantilla de Jugadores"
- ✅ Muestra número de camisa, nombre completo y posición
- ✅ Estado del jugador es "ACTIVO"
- ✅ Contador de jugadores se incrementa

#### Validaciones a Verificar:
- ❌ Campos nombre y apellidos son obligatorios
- ❌ Número de camisa solo acepta valores 1-99
- ❌ Delegados solo pueden agregar jugadores a sus equipos
- ✅ Posición tiene opciones predefinidas (Portero, Defensa, etc.)

---

### Escenario 3: Editar Información de un Equipo

**Como:** Delegado o Superadmin  
**Quiero:** Actualizar la información de mi equipo  
**Para:** Mantener los datos actualizados

#### Pasos:
1. Iniciar sesión con usuario delegado (o superadmin)
2. Navegar a **Equipos** desde el menú lateral
3. Seleccionar un equipo (propio si eres delegado)
4. En la sección "Acciones", hacer clic en **"Editar Equipo"**
5. Modificar los campos deseados:
   - **Nombre:** Actualizar nombre del equipo
   - **Color Primario:** Seleccionar nuevo color con picker
   - **Color Secundario:** Seleccionar nuevo color con picker
   - **Teléfono:** 442 123 4567
   - **Email:** equipo@ejemplo.com
   - **Logo:** Subir nueva imagen (opcional)
6. Hacer clic en **"Guardar Cambios"**

#### Resultado Esperado:
- ✅ Mensaje de éxito: "Equipo actualizado exitosamente"
- ✅ Redirige a la vista detalle del equipo
- ✅ Los cambios se reflejan inmediatamente
- ✅ Si se subió logo, se muestra el nuevo logo
- ✅ Los colores se actualizan en los cuadros de color

#### Validaciones a Verificar:
- ❌ Campo nombre es obligatorio
- ❌ Delegados solo pueden editar sus propios equipos
- ✅ Logo acepta formatos JPG, PNG, GIF
- ✅ Si no se sube logo, se mantiene el anterior
- ✅ Selectores de color funcionan correctamente

---

### Escenario 4: Ver Equipos Inscritos en un Torneo

**Como:** Cualquier usuario autenticado  
**Quiero:** Ver qué equipos están inscritos en un torneo  
**Para:** Conocer los participantes

#### Pasos:
1. Iniciar sesión con cualquier rol
2. Navegar a **Torneos** desde el menú lateral
3. Seleccionar cualquier torneo
4. Observar la sección "Equipos Inscritos" en el sidebar derecho

#### Resultado Esperado:
- ✅ Se muestra el número total de equipos inscritos
- ✅ Cada equipo muestra su logo (o inicial si no tiene)
- ✅ Se muestra el nombre del equipo
- ✅ Se muestra el grupo si está asignado
- ✅ Se muestra el estado de inscripción (APROBADO/PENDIENTE)
- ✅ Los equipos son clickables y llevan al detalle del equipo
- ✅ Si no hay equipos, muestra mensaje apropiado

---

## Pruebas de Permisos

### Delegado
- ✅ Puede ver todos los equipos
- ✅ Puede inscribir sus equipos a torneos
- ✅ Puede agregar jugadores solo a sus equipos
- ✅ Puede editar solo sus equipos
- ❌ No puede editar equipos de otros delegados

### Organizador
- ✅ Puede ver todos los equipos
- ✅ Puede inscribir equipos a sus torneos
- ✅ Puede ver todos los equipos inscritos en sus torneos
- ❌ No puede agregar jugadores (no es su función)
- ❌ No puede editar equipos (no es su función)

### Superadmin
- ✅ Puede hacer todo lo anterior
- ✅ Puede inscribir cualquier equipo a cualquier torneo
- ✅ Puede agregar jugadores a cualquier equipo
- ✅ Puede editar cualquier equipo

---

## Pruebas de Interfaz

### Navegación
- ✅ Todos los enlaces funcionan correctamente
- ✅ Los botones "Cancelar" regresan a la vista anterior
- ✅ Los botones "Volver" regresan al listado correspondiente
- ✅ Los mensajes flash aparecen y desaparecen correctamente

### Formularios
- ✅ Todos los campos obligatorios están marcados con *
- ✅ Los placeholders proporcionan ejemplos útiles
- ✅ Los selectores de color funcionan en todos los navegadores
- ✅ El selector de archivos acepta solo imágenes
- ✅ Los campos numéricos tienen validación min/max

### Diseño Responsivo
- ✅ Las vistas se ven bien en desktop (1920x1080)
- ✅ Las vistas se ven bien en tablet (768x1024)
- ✅ Las vistas se ven bien en móvil (375x667)
- ✅ Los formularios son usables en todas las resoluciones

---

## Casos Edge y Manejo de Errores

### Datos Inválidos
- ✅ Intentar inscribir sin seleccionar equipo → muestra error
- ✅ Intentar inscribir equipo ya inscrito → muestra error
- ✅ Intentar inscribir a torneo no en INSCRIPCIONES → muestra error
- ✅ Intentar agregar jugador sin nombre → validación HTML5
- ✅ Intentar editar con nombre vacío → validación HTML5

### Permisos Insuficientes
- ✅ Delegado intenta editar equipo de otro → redirige con error
- ✅ Delegado intenta agregar jugador a equipo de otro → redirige con error
- ✅ Usuario no autenticado intenta acceder → redirige a login

### Recursos No Encontrados
- ✅ ID de equipo inexistente → redirige con mensaje de error
- ✅ ID de torneo inexistente → redirige con mensaje de error

---

## Pruebas de Integración

### Flujo Completo: Inscribir Equipo y Agregar Jugadores
1. Crear un torneo nuevo (como ORGANIZADOR)
2. Inscribir un equipo al torneo (como DELEGADO)
3. Verificar que el equipo aparece en el torneo
4. Agregar 3 jugadores al equipo
5. Verificar que los jugadores aparecen en la plantilla
6. Editar información del equipo
7. Verificar que los cambios se guardaron

**Resultado Esperado:**
- ✅ Todo el flujo funciona sin errores
- ✅ Los datos son consistentes en todas las vistas
- ✅ Los contadores se actualizan correctamente

---

## Checklist de Validación Final

- [ ] Todas las funcionalidades implementadas funcionan
- [ ] Los permisos se respetan en cada operación
- [ ] Los mensajes de error son claros y útiles
- [ ] Los mensajes de éxito confirman la acción realizada
- [ ] No hay errores de sintaxis PHP
- [ ] No hay errores de JavaScript en consola
- [ ] La interfaz es consistente con el resto del sistema
- [ ] El código sigue los patrones MVC existentes
- [ ] Todas las consultas SQL usan prepared statements
- [ ] Los datos de entrada se sanitizan apropiadamente
- [ ] Las vistas usan Tailwind CSS correctamente
- [ ] Los íconos de Font Awesome se muestran correctamente
- [ ] Las imágenes se suben y muestran correctamente
- [ ] Los colores seleccionados se aplican correctamente

---

## Problemas Conocidos y Limitaciones

1. **Subida de Logo:** No hay validación de tamaño de archivo en el lado del servidor
2. **Jugadores Duplicados:** No hay validación para evitar números de camisa duplicados
3. **Límite de Equipos:** No hay validación del límite de equipos por torneo
4. **Notificaciones:** No se envían notificaciones por email al inscribir equipos
5. **Búsqueda:** No hay funcionalidad de búsqueda en los dropdowns

Estas limitaciones no afectan la funcionalidad básica pero podrían ser mejoras futuras.

---

## Contacto para Reportar Issues

Si encuentras algún problema durante las pruebas, por favor reporta:
- Descripción del problema
- Pasos para reproducir
- Rol de usuario utilizado
- Navegador y versión
- Capturas de pantalla si es posible

## Conclusión

Todas las funcionalidades solicitadas han sido implementadas y están listas para pruebas. El sistema mantiene la consistencia con el código existente y sigue las mejores prácticas de seguridad y usabilidad.
