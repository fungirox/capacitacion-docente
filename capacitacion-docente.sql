USE [capacitacion-docente]
GO
/****** Object:  Table [dbo].[tblAdmin]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblAdmin](
	[ADMINID] [bigint] IDENTITY(1,1) NOT NULL,
	[USERID] [bigint] NOT NULL,
 CONSTRAINT [tbladmin_adminid_primary] PRIMARY KEY CLUSTERED 
(
	[ADMINID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblArea]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblArea](
	[AREAID] [bigint] IDENTITY(1,1) NOT NULL,
	[AREA_Nombre] [varchar](255) NOT NULL,
	[AREA_Siglas] [varchar](255) NOT NULL,
	[AREA_Archivado] [bit] NOT NULL,
	[AREA_Carrera] [bit] NOT NULL,
 CONSTRAINT [tblarea_areaid_primary] PRIMARY KEY CLUSTERED 
(
	[AREAID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblAsistenciaCurso]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblAsistenciaCurso](
	[ASISTENCIACURSOID] [bigint] IDENTITY(1,1) NOT NULL,
	[CURSOID] [bigint] NOT NULL,
	[DOCENTEID] [bigint] NOT NULL,
	[ASISTENCIACURSO_Fecha] [date] NOT NULL,
 CONSTRAINT [tblasistenciacurso_asistenciacursoid_primary] PRIMARY KEY CLUSTERED 
(
	[ASISTENCIACURSOID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblConstancia]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblConstancia](
	[CONSTANCIAID] [bigint] IDENTITY(1,1) NOT NULL,
	[CONSTANCIA_Folio] [varchar](50) NULL,
	[CURSOID] [bigint] NULL,
	[USERID] [bigint] NULL,
	[CONSTANCIA_Docente] [bit] NULL,
PRIMARY KEY CLUSTERED 
(
	[CONSTANCIAID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblCurso]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblCurso](
	[CURSOID] [bigint] IDENTITY(1,1) NOT NULL,
	[CURSO_Nombre] [varchar](255) NOT NULL,
	[CURSO_Descripcion] [text] NULL,
	[CURSO_Tipo] [varchar](255) NOT NULL,
	[CURSO_Total_Horas] [int] NOT NULL,
	[CURSO_Fecha_Inicio] [date] NOT NULL,
	[CURSO_Fecha_Final] [date] NOT NULL,
	[CURSO_Externo] [bit] NOT NULL,
	[CURSO_Modalidad] [varchar](255) NOT NULL,
	[CURSO_Perfil] [bigint] NOT NULL,
	[CURSO_Archivado] [bit] NOT NULL,
	[CURSO_Aula] [varchar](80) NULL,
	[CURSO_Horas_Presenciales] [int] NULL,
	[CURSO_Limite] [int] NULL,
	[PERSONALID] [bigint] NULL,
	[CURSO_Estado] [varchar](50) NOT NULL,
	[CURSO_Reprogramado] [bit] NULL,
 CONSTRAINT [tblcurso_cursoid_primary] PRIMARY KEY CLUSTERED 
(
	[CURSOID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblCursoArea]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblCursoArea](
	[CURSOAREAID] [bigint] IDENTITY(1,1) NOT NULL,
	[CURSOID] [bigint] NOT NULL,
	[AREAID] [bigint] NOT NULL,
 CONSTRAINT [tblcursoarea_cursoareaid_primary] PRIMARY KEY CLUSTERED 
(
	[CURSOAREAID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblCursoDocente]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblCursoDocente](
	[CURSODOCENTEID] [bigint] IDENTITY(1,1) NOT NULL,
	[CURSOID] [bigint] NOT NULL,
	[DOCENTEID] [bigint] NOT NULL,
	[CURSODOCENTE_Calificacion] [int] NOT NULL,
	[CURSODOCENTE_EncuestaEficacia] [bit] NULL,
	[CURSODOCENTE_EncuestaEvaluacion] [bit] NULL,
 CONSTRAINT [tblcalificacion_calificacionid_primary] PRIMARY KEY CLUSTERED 
(
	[CURSODOCENTEID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblCursoInstructor]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblCursoInstructor](
	[CURSOINSTRUCTORID] [bigint] IDENTITY(1,1) NOT NULL,
	[CURSOID] [bigint] NOT NULL,
	[INSTRUCTORID] [bigint] NOT NULL,
 CONSTRAINT [tblcursoinstructor_cursoinstructor_id_primary] PRIMARY KEY CLUSTERED 
(
	[CURSOINSTRUCTORID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblDocente]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblDocente](
	[DOCENTEID] [bigint] IDENTITY(1,1) NOT NULL,
	[USERID] [bigint] NOT NULL,
	[DOCENTE_Nomina] [varchar](255) NOT NULL,
	[DOCENTE_Base] [bit] NOT NULL,
	[DOCENTE_Horas_Base] [int] NULL,
 CONSTRAINT [tbldocente_docenteid_primary] PRIMARY KEY CLUSTERED 
(
	[DOCENTEID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblDocenteArea]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblDocenteArea](
	[DOCENTEAREAID] [bigint] IDENTITY(1,1) NOT NULL,
	[DOCENTEID] [bigint] NOT NULL,
	[AREAID] [bigint] NOT NULL,
 CONSTRAINT [tbldocentearea_docenteareaid_primary] PRIMARY KEY CLUSTERED 
(
	[DOCENTEAREAID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblEncuesta]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblEncuesta](
	[ENCUESTAID] [bigint] IDENTITY(1,1) NOT NULL,
	[ENCUESTA_Nombre] [varchar](50) NULL,
	[ENCUESTA_Descripcion] [varchar](255) NULL,
 CONSTRAINT [PK_tblEncuesta] PRIMARY KEY CLUSTERED 
(
	[ENCUESTAID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblHorarioCurso]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblHorarioCurso](
	[HORARIOCURSOID] [bigint] IDENTITY(1,1) NOT NULL,
	[CURSOID] [bigint] NOT NULL,
	[HORARIOCURSO_Dia_Semana] [varchar](255) NOT NULL,
	[HORARIOCURSO_Hora_Inicio] [time](7) NOT NULL,
	[HORARIOCURSO_Horas] [int] NOT NULL,
	[HORARIOCURSO_Hora_Final] [time](7) NOT NULL,
 CONSTRAINT [tblhorariocurso_horariocursoid_primary] PRIMARY KEY CLUSTERED 
(
	[HORARIOCURSOID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblInstructor]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblInstructor](
	[INSTRUCTORID] [bigint] IDENTITY(1,1) NOT NULL,
	[USERID] [bigint] NOT NULL,
	[INSTRUCTOR_Estudios] [varchar](100) NOT NULL,
 CONSTRAINT [tblinstructor_instructorid_primary] PRIMARY KEY CLUSTERED 
(
	[INSTRUCTORID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblPersonal]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblPersonal](
	[PERSONALID] [bigint] IDENTITY(1,1) NOT NULL,
	[PERSONAL_Nombre] [varchar](255) NULL,
	[PERSONAL_Puesto] [varchar](255) NULL,
	[PERSONAL_Titulo] [varchar](15) NULL,
	[PERSONAL_Archivado] [bit] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[PERSONALID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblPregunta]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblPregunta](
	[PREGUNTAID] [bigint] IDENTITY(1,1) NOT NULL,
	[ENCUESTAID] [bigint] NOT NULL,
	[PREGUNTA_Texto] [text] NULL,
 CONSTRAINT [PK_tblPregunta] PRIMARY KEY CLUSTERED 
(
	[PREGUNTAID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblRespuesta]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblRespuesta](
	[RESPUESTAID] [bigint] IDENTITY(1,1) NOT NULL,
	[DOCENTEID] [bigint] NULL,
	[ENCUESTAID] [bigint] NULL,
	[CURSOID] [bigint] NULL,
PRIMARY KEY CLUSTERED 
(
	[RESPUESTAID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblRespuestaPregunta]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblRespuestaPregunta](
	[RESPUESTAPREGUNTAID] [bigint] IDENTITY(1,1) NOT NULL,
	[RESPUESTAPREGUNTA_Texto] [varchar](max) NULL,
	[RESPUESTAID] [bigint] NULL,
	[PREGUNTAID] [bigint] NULL,
PRIMARY KEY CLUSTERED 
(
	[RESPUESTAPREGUNTAID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblUsuario]    Script Date: 04/03/2025 08:04:55 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblUsuario](
	[USERID] [bigint] IDENTITY(1,1) NOT NULL,
	[USER_Nombre] [varchar](255) NOT NULL,
	[USER_Apellido] [varchar](255) NOT NULL,
	[USER_Genero] [bit] NOT NULL,
	[USER_Email] [varchar](255) NOT NULL,
	[USER_NombreUsuario] [varchar](50) NOT NULL,
	[USER_Password] [varchar](255) NULL,
	[USER_Activo] [bit] NOT NULL,
 CONSTRAINT [tblusuario_userid_primary] PRIMARY KEY CLUSTERED 
(
	[USERID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[tblArea] ADD  DEFAULT ((0)) FOR [AREA_Archivado]
GO
ALTER TABLE [dbo].[tblCurso] ADD  DEFAULT ((0)) FOR [CURSO_Archivado]
GO
ALTER TABLE [dbo].[tblCurso] ADD  CONSTRAINT [curso_reprogramado_default]  DEFAULT ((0)) FOR [CURSO_Reprogramado]
GO
ALTER TABLE [dbo].[tblPersonal] ADD  DEFAULT ((0)) FOR [PERSONAL_Archivado]
GO
ALTER TABLE [dbo].[tblUsuario] ADD  CONSTRAINT [DF_Usuario_Activo]  DEFAULT ((1)) FOR [USER_Activo]
GO
ALTER TABLE [dbo].[tblAdmin]  WITH CHECK ADD  CONSTRAINT [tbladmin_userid_foreign] FOREIGN KEY([USERID])
REFERENCES [dbo].[tblUsuario] ([USERID])
GO
ALTER TABLE [dbo].[tblAdmin] CHECK CONSTRAINT [tbladmin_userid_foreign]
GO
ALTER TABLE [dbo].[tblAsistenciaCurso]  WITH CHECK ADD  CONSTRAINT [tblasistenciacurso_cursoid_foreign] FOREIGN KEY([CURSOID])
REFERENCES [dbo].[tblCurso] ([CURSOID])
GO
ALTER TABLE [dbo].[tblAsistenciaCurso] CHECK CONSTRAINT [tblasistenciacurso_cursoid_foreign]
GO
ALTER TABLE [dbo].[tblAsistenciaCurso]  WITH CHECK ADD  CONSTRAINT [tblasistenciacurso_docenteid_foreign] FOREIGN KEY([DOCENTEID])
REFERENCES [dbo].[tblDocente] ([DOCENTEID])
GO
ALTER TABLE [dbo].[tblAsistenciaCurso] CHECK CONSTRAINT [tblasistenciacurso_docenteid_foreign]
GO
ALTER TABLE [dbo].[tblConstancia]  WITH CHECK ADD  CONSTRAINT [FK_Constancia_Curso] FOREIGN KEY([CURSOID])
REFERENCES [dbo].[tblCurso] ([CURSOID])
GO
ALTER TABLE [dbo].[tblConstancia] CHECK CONSTRAINT [FK_Constancia_Curso]
GO
ALTER TABLE [dbo].[tblConstancia]  WITH CHECK ADD  CONSTRAINT [FK_Constancia_Usuario] FOREIGN KEY([USERID])
REFERENCES [dbo].[tblUsuario] ([USERID])
GO
ALTER TABLE [dbo].[tblConstancia] CHECK CONSTRAINT [FK_Constancia_Usuario]
GO
ALTER TABLE [dbo].[tblCurso]  WITH CHECK ADD  CONSTRAINT [FK_Curso_Personal] FOREIGN KEY([PERSONALID])
REFERENCES [dbo].[tblPersonal] ([PERSONALID])
GO
ALTER TABLE [dbo].[tblCurso] CHECK CONSTRAINT [FK_Curso_Personal]
GO
ALTER TABLE [dbo].[tblCursoArea]  WITH CHECK ADD  CONSTRAINT [tblcursoarea_areaid_foreign] FOREIGN KEY([AREAID])
REFERENCES [dbo].[tblArea] ([AREAID])
GO
ALTER TABLE [dbo].[tblCursoArea] CHECK CONSTRAINT [tblcursoarea_areaid_foreign]
GO
ALTER TABLE [dbo].[tblCursoArea]  WITH CHECK ADD  CONSTRAINT [tblcursoarea_cursoid_foreign] FOREIGN KEY([CURSOID])
REFERENCES [dbo].[tblCurso] ([CURSOID])
GO
ALTER TABLE [dbo].[tblCursoArea] CHECK CONSTRAINT [tblcursoarea_cursoid_foreign]
GO
ALTER TABLE [dbo].[tblCursoDocente]  WITH CHECK ADD  CONSTRAINT [tblcalificacion_cursoid_foreign] FOREIGN KEY([CURSOID])
REFERENCES [dbo].[tblCurso] ([CURSOID])
GO
ALTER TABLE [dbo].[tblCursoDocente] CHECK CONSTRAINT [tblcalificacion_cursoid_foreign]
GO
ALTER TABLE [dbo].[tblCursoDocente]  WITH CHECK ADD  CONSTRAINT [tblcalificacion_docenteid_foreign] FOREIGN KEY([DOCENTEID])
REFERENCES [dbo].[tblDocente] ([DOCENTEID])
GO
ALTER TABLE [dbo].[tblCursoDocente] CHECK CONSTRAINT [tblcalificacion_docenteid_foreign]
GO
ALTER TABLE [dbo].[tblCursoInstructor]  WITH CHECK ADD  CONSTRAINT [tblcursoinstructor_cursoid_foreign] FOREIGN KEY([CURSOID])
REFERENCES [dbo].[tblCurso] ([CURSOID])
GO
ALTER TABLE [dbo].[tblCursoInstructor] CHECK CONSTRAINT [tblcursoinstructor_cursoid_foreign]
GO
ALTER TABLE [dbo].[tblCursoInstructor]  WITH CHECK ADD  CONSTRAINT [tblcursoinstructor_instructorid_foreign] FOREIGN KEY([INSTRUCTORID])
REFERENCES [dbo].[tblInstructor] ([INSTRUCTORID])
GO
ALTER TABLE [dbo].[tblCursoInstructor] CHECK CONSTRAINT [tblcursoinstructor_instructorid_foreign]
GO
ALTER TABLE [dbo].[tblDocente]  WITH CHECK ADD  CONSTRAINT [tbldocente_userid_foreign] FOREIGN KEY([USERID])
REFERENCES [dbo].[tblUsuario] ([USERID])
GO
ALTER TABLE [dbo].[tblDocente] CHECK CONSTRAINT [tbldocente_userid_foreign]
GO
ALTER TABLE [dbo].[tblDocenteArea]  WITH CHECK ADD  CONSTRAINT [tbldocentearea_areaid_foreign] FOREIGN KEY([AREAID])
REFERENCES [dbo].[tblArea] ([AREAID])
GO
ALTER TABLE [dbo].[tblDocenteArea] CHECK CONSTRAINT [tbldocentearea_areaid_foreign]
GO
ALTER TABLE [dbo].[tblDocenteArea]  WITH CHECK ADD  CONSTRAINT [tbldocentearea_docenteid_foreign] FOREIGN KEY([DOCENTEID])
REFERENCES [dbo].[tblDocente] ([DOCENTEID])
GO
ALTER TABLE [dbo].[tblDocenteArea] CHECK CONSTRAINT [tbldocentearea_docenteid_foreign]
GO
ALTER TABLE [dbo].[tblHorarioCurso]  WITH CHECK ADD  CONSTRAINT [tblhorariocurso_cursoid_foreign] FOREIGN KEY([CURSOID])
REFERENCES [dbo].[tblCurso] ([CURSOID])
GO
ALTER TABLE [dbo].[tblHorarioCurso] CHECK CONSTRAINT [tblhorariocurso_cursoid_foreign]
GO
ALTER TABLE [dbo].[tblInstructor]  WITH CHECK ADD  CONSTRAINT [tblinstructor_userid_foreign] FOREIGN KEY([USERID])
REFERENCES [dbo].[tblUsuario] ([USERID])
GO
ALTER TABLE [dbo].[tblInstructor] CHECK CONSTRAINT [tblinstructor_userid_foreign]
GO
ALTER TABLE [dbo].[tblPregunta]  WITH CHECK ADD  CONSTRAINT [FK_tblPregunta_tblEncuesta] FOREIGN KEY([ENCUESTAID])
REFERENCES [dbo].[tblEncuesta] ([ENCUESTAID])
GO
ALTER TABLE [dbo].[tblPregunta] CHECK CONSTRAINT [FK_tblPregunta_tblEncuesta]
GO
ALTER TABLE [dbo].[tblRespuesta]  WITH CHECK ADD  CONSTRAINT [FK_tblRespuesta_Curso] FOREIGN KEY([CURSOID])
REFERENCES [dbo].[tblCurso] ([CURSOID])
GO
ALTER TABLE [dbo].[tblRespuesta] CHECK CONSTRAINT [FK_tblRespuesta_Curso]
GO
ALTER TABLE [dbo].[tblRespuesta]  WITH CHECK ADD  CONSTRAINT [FK_tblRespuesta_Docente] FOREIGN KEY([DOCENTEID])
REFERENCES [dbo].[tblDocente] ([DOCENTEID])
GO
ALTER TABLE [dbo].[tblRespuesta] CHECK CONSTRAINT [FK_tblRespuesta_Docente]
GO
ALTER TABLE [dbo].[tblRespuesta]  WITH CHECK ADD  CONSTRAINT [FK_tblRespuesta_Encuesta] FOREIGN KEY([ENCUESTAID])
REFERENCES [dbo].[tblEncuesta] ([ENCUESTAID])
GO
ALTER TABLE [dbo].[tblRespuesta] CHECK CONSTRAINT [FK_tblRespuesta_Encuesta]
GO
ALTER TABLE [dbo].[tblRespuestaPregunta]  WITH CHECK ADD  CONSTRAINT [FK_tblRespuestaPregunta_Pregunta] FOREIGN KEY([PREGUNTAID])
REFERENCES [dbo].[tblPregunta] ([PREGUNTAID])
GO
ALTER TABLE [dbo].[tblRespuestaPregunta] CHECK CONSTRAINT [FK_tblRespuestaPregunta_Pregunta]
GO
ALTER TABLE [dbo].[tblRespuestaPregunta]  WITH CHECK ADD  CONSTRAINT [FK_tblRespuestaPregunta_Respuesta] FOREIGN KEY([RESPUESTAID])
REFERENCES [dbo].[tblRespuesta] ([RESPUESTAID])
GO
ALTER TABLE [dbo].[tblRespuestaPregunta] CHECK CONSTRAINT [FK_tblRespuestaPregunta_Respuesta]
GO
