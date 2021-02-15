# Ikaru - Na

This project is the back-end development for a page called Ikaru-Na, which offers holistic services.

## DATABASE TABLES
    user (id,username,email,phone)
    therapy(id,name,description,therapist_id)
    workshop(id,name,caption,description,modality) add->image
    question(id,text,user_id)
    shift(id,date,time,therapy_id,therapist_id,user_id)
    notification(id,text,user_id)

## USER STORIES
-: TODO     +: DONE     ?: MIDDLE       X: FAIL

SIN IMPORTAR MI CONDICIÓN DEBO PODER:
	+acceder al listado de terapias.
	+acceder al listado de talleres.
	?acceder al enlace para comunicarme vía whataspp con las administradoras.
	+darme de alta como nuevo usuario.
	+loguearme.

COMO USUARIO LOGUEADO DEBO PODER:
	+hacer una consulta.
	Xsacar un turno.
	-ver mis turnos pendientes y aceptados.
	?solicitar hacer un taller.
	-ver mis notificaciones.
	-eliminar mis notifcaciones de una en una.
	-eliminar todas mis notificaciones a la vez.
	-editar mis datos de contacto.
	
COMO ADMIN DEBO PODER:
	+agregar, eliminar y editar terapias 
	+agregar, eliminar y editar talleres 
	+acceder al listado de preguntas.
	?acceder al listado completo de turnos.
	-agregar un turno ya confirmado (status = 1).
	-confirmar un turno solicitado. (cambiar el status=0->1).
	-cambiar la fecha y hora de un turno. Si el turno tenía status==0, al cambiar la fecha y hora se confirma (status = 1).
	+acceder al listado de usuarios.
	+eliminar un usuario.