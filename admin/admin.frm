VERSION 5.00
Begin VB.Form frmPerfis 
   BorderStyle     =   3  'Fixed Dialog
   Caption         =   "Aprovação de Perfis"
   ClientHeight    =   8235
   ClientLeft      =   1095
   ClientTop       =   375
   ClientWidth     =   12270
   BeginProperty Font 
      Name            =   "Tahoma"
      Size            =   8.25
      Charset         =   0
      Weight          =   400
      Underline       =   0   'False
      Italic          =   0   'False
      Strikethrough   =   0   'False
   EndProperty
   Icon            =   "admin.frx":0000
   KeyPreview      =   -1  'True
   LinkTopic       =   "Form2"
   MaxButton       =   0   'False
   MinButton       =   0   'False
   ScaleHeight     =   8235
   ScaleWidth      =   12270
   StartUpPosition =   2  'CenterScreen
   Begin VB.PictureBox picButtons 
      Align           =   2  'Align Bottom
      Appearance      =   0  'Flat
      BorderStyle     =   0  'None
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H80000008&
      Height          =   420
      Left            =   0
      ScaleHeight     =   420
      ScaleWidth      =   12270
      TabIndex        =   0
      Top             =   7815
      Width           =   12270
      Begin VB.CommandButton cmdRemove 
         Caption         =   "&REMOVER PERFIL"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   6480
         MaskColor       =   &H000000FF&
         Style           =   1  'Graphical
         TabIndex        =   49
         Top             =   0
         Width           =   2175
      End
      Begin VB.CommandButton cmdFirst 
         BeginProperty Font 
            Name            =   "MS Sans Serif"
            Size            =   8.25
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   240
         Picture         =   "admin.frx":000C
         Style           =   1  'Graphical
         TabIndex        =   8
         Top             =   0
         UseMaskColor    =   -1  'True
         Width           =   345
      End
      Begin VB.CommandButton cmdPrevious 
         BeginProperty Font 
            Name            =   "MS Sans Serif"
            Size            =   8.25
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   600
         Picture         =   "admin.frx":034E
         Style           =   1  'Graphical
         TabIndex        =   7
         Top             =   0
         UseMaskColor    =   -1  'True
         Width           =   345
      End
      Begin VB.CommandButton cmdNext 
         BeginProperty Font 
            Name            =   "MS Sans Serif"
            Size            =   8.25
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   960
         Picture         =   "admin.frx":0690
         Style           =   1  'Graphical
         TabIndex        =   6
         Top             =   0
         UseMaskColor    =   -1  'True
         Width           =   345
      End
      Begin VB.CommandButton cmdLast 
         BeginProperty Font 
            Name            =   "MS Sans Serif"
            Size            =   8.25
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   1320
         Picture         =   "admin.frx":09D2
         Style           =   1  'Graphical
         TabIndex        =   5
         Top             =   0
         UseMaskColor    =   -1  'True
         Width           =   345
      End
      Begin VB.CommandButton cmdCancel 
         Caption         =   "&Cancelar"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   10920
         TabIndex        =   4
         Top             =   0
         Visible         =   0   'False
         Width           =   1095
      End
      Begin VB.CommandButton cmdUpdate 
         Caption         =   "&Salvar"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   8880
         TabIndex        =   3
         Top             =   0
         Visible         =   0   'False
         Width           =   1815
      End
      Begin VB.CommandButton cmdRefresh 
         Caption         =   "&Atualizar "
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   10920
         TabIndex        =   2
         Top             =   0
         Width           =   1095
      End
      Begin VB.CommandButton cmdEdit 
         Caption         =   "&Atualizar Dados"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   8880
         TabIndex        =   1
         Top             =   0
         Width           =   1815
      End
   End
   Begin VB.Frame frmForm 
      Enabled         =   0   'False
      Height          =   7575
      Left            =   240
      TabIndex        =   9
      Top             =   120
      Width           =   11775
      Begin VB.ComboBox Combo1 
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   360
         ItemData        =   "admin.frx":0D14
         Left            =   360
         List            =   "admin.frx":0D21
         Style           =   2  'Dropdown List
         TabIndex        =   25
         Top             =   2400
         Width           =   2775
      End
      Begin VB.TextBox txtFields 
         DataField       =   "lido"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   270
         Index           =   13
         Left            =   2160
         TabIndex        =   29
         Top             =   2400
         Width           =   855
      End
      Begin VB.TextBox txtFields 
         DataField       =   "pesid"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   1
         Left            =   1560
         TabIndex        =   28
         Top             =   2400
         Width           =   495
      End
      Begin VB.TextBox txtFields 
         DataField       =   "documento"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   2
         Left            =   360
         TabIndex        =   27
         Top             =   7080
         Width           =   5415
      End
      Begin VB.TextBox txtFields 
         DataField       =   "aprovado"
         BeginProperty Font 
            Name            =   "MS Sans Serif"
            Size            =   8.25
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   0
         Left            =   480
         TabIndex        =   26
         Top             =   2400
         Width           =   495
      End
      Begin VB.TextBox txtFields 
         DataField       =   "nome"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   3
         Left            =   360
         TabIndex        =   24
         Top             =   600
         Width           =   3855
      End
      Begin VB.TextBox txtFields 
         DataField       =   "apelido"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   4
         Left            =   4320
         TabIndex        =   23
         Top             =   600
         Width           =   2415
      End
      Begin VB.TextBox txtFields 
         DataField       =   "cadastro"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   5
         Left            =   9240
         TabIndex        =   22
         Top             =   600
         Width           =   2175
      End
      Begin VB.TextBox txtFields 
         DataField       =   "sexo"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   6
         Left            =   360
         TabIndex        =   21
         Top             =   1200
         Width           =   1575
      End
      Begin VB.TextBox txtFields 
         DataField       =   "nascimento"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   7
         Left            =   6600
         TabIndex        =   20
         Top             =   1200
         Width           =   1935
      End
      Begin VB.TextBox txtFields 
         DataField       =   "rg"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   8
         Left            =   2040
         TabIndex        =   19
         Top             =   1200
         Width           =   2175
      End
      Begin VB.TextBox txtFields 
         DataField       =   "cpf"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   9
         Left            =   4320
         TabIndex        =   18
         Top             =   1200
         Width           =   2175
      End
      Begin VB.TextBox txtFields 
         DataField       =   "url"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   10
         Left            =   6840
         TabIndex        =   17
         Top             =   600
         Width           =   2295
      End
      Begin VB.TextBox txtFields 
         DataField       =   "comprovacao"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   11
         Left            =   6000
         TabIndex        =   16
         Top             =   7080
         Width           =   5415
      End
      Begin VB.TextBox txtFields 
         DataField       =   "mensagem"
         BeginProperty Font 
            Name            =   "Courier New"
            Size            =   6.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   360
         Index           =   12
         Left            =   4680
         MultiLine       =   -1  'True
         TabIndex        =   15
         Top             =   2400
         Width           =   4575
      End
      Begin VB.CommandButton cmdReprov 
         Caption         =   "Reprovação"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   8.25
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   350
         Left            =   3120
         TabIndex        =   14
         Top             =   2400
         Width           =   1335
      End
      Begin VB.TextBox txtFields 
         DataField       =   "whatsapp"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   14
         Left            =   360
         TabIndex        =   13
         Top             =   1800
         Width           =   1935
      End
      Begin VB.TextBox txtFields 
         DataField       =   "tel1"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   15
         Left            =   2400
         TabIndex        =   12
         Top             =   1800
         Width           =   1935
      End
      Begin VB.TextBox txtFields 
         DataField       =   "tel2"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   16
         Left            =   4440
         TabIndex        =   11
         Top             =   1800
         Width           =   2055
      End
      Begin VB.TextBox txtFields 
         DataField       =   "email"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   285
         Index           =   17
         Left            =   6600
         Locked          =   -1  'True
         TabIndex        =   10
         Top             =   1800
         Width           =   4815
      End
      Begin VB.Image Documento 
         BorderStyle     =   1  'Fixed Single
         Height          =   4095
         Left            =   360
         Stretch         =   -1  'True
         Top             =   3240
         Width           =   5415
      End
      Begin VB.Image Comprovacao 
         BorderStyle     =   1  'Fixed Single
         Height          =   4095
         Left            =   6000
         Stretch         =   -1  'True
         Top             =   3240
         Width           =   5415
      End
      Begin VB.Label lblLabels 
         Caption         =   "Documento Original:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   3
         Left            =   360
         TabIndex        =   48
         Top             =   2880
         Width           =   2055
      End
      Begin VB.Label lblLabels 
         Caption         =   "Comprovação de Identidade:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   4
         Left            =   6000
         TabIndex        =   47
         Top             =   2880
         Width           =   3255
      End
      Begin VB.Label lblLabels 
         Caption         =   "Nome Completo:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   0
         Left            =   360
         TabIndex        =   46
         Top             =   360
         Width           =   2055
      End
      Begin VB.Label lblLabels 
         Caption         =   "Apelido:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   1
         Left            =   4320
         TabIndex        =   45
         Top             =   360
         Width           =   2055
      End
      Begin VB.Label lblLabels 
         Caption         =   "Data de Cadastro:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   2
         Left            =   9240
         TabIndex        =   44
         Top             =   360
         Width           =   2055
      End
      Begin VB.Label lblLabels 
         Caption         =   "Sexo:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   5
         Left            =   360
         TabIndex        =   43
         Top             =   960
         Width           =   1575
      End
      Begin VB.Label lblLabels 
         Caption         =   "Data de Nascimento:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   6
         Left            =   6600
         TabIndex        =   42
         Top             =   960
         Width           =   2055
      End
      Begin VB.Label lblLabels 
         Caption         =   "RG:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   7
         Left            =   2040
         TabIndex        =   41
         Top             =   960
         Width           =   2055
      End
      Begin VB.Label lblLabels 
         Caption         =   "CPF:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   8
         Left            =   4320
         TabIndex        =   40
         Top             =   960
         Width           =   2055
      End
      Begin VB.Label lblIdade 
         Alignment       =   1  'Right Justify
         AutoSize        =   -1  'True
         Caption         =   "00 ANOS"
         DataField       =   "idade"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   27.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         ForeColor       =   &H00000040&
         Height          =   675
         Left            =   8760
         TabIndex        =   39
         Top             =   915
         Width           =   2580
      End
      Begin VB.Label lblLabels 
         Caption         =   "Status do Perfil:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   9
         Left            =   9480
         TabIndex        =   38
         Top             =   2160
         Width           =   1695
      End
      Begin VB.Label lblAprovado 
         Caption         =   "AGUARDANDO"
         DataField       =   "status_aprovado"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   12
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         ForeColor       =   &H00000080&
         Height          =   255
         Left            =   9480
         TabIndex        =   37
         Top             =   2400
         Width           =   1935
      End
      Begin VB.Label lblLabels 
         Caption         =   "URL Amigável:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   10
         Left            =   6840
         TabIndex        =   36
         Top             =   360
         Width           =   2055
      End
      Begin VB.Label lblLabels 
         Caption         =   "Alterar Status:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   11
         Left            =   360
         TabIndex        =   35
         Top             =   2160
         Width           =   1935
      End
      Begin VB.Label lblLabels 
         Caption         =   "Motivo Reprovação:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   12
         Left            =   4680
         TabIndex        =   34
         Top             =   2160
         Width           =   2415
      End
      Begin VB.Label lblLabels 
         Caption         =   "WhatsApp:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   13
         Left            =   360
         TabIndex        =   33
         Top             =   1560
         Width           =   2055
      End
      Begin VB.Label lblLabels 
         Caption         =   "Telefone 1:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   14
         Left            =   2400
         TabIndex        =   32
         Top             =   1560
         Width           =   2055
      End
      Begin VB.Label lblLabels 
         Caption         =   "Telefone 2:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   15
         Left            =   4440
         TabIndex        =   31
         Top             =   1560
         Width           =   2055
      End
      Begin VB.Label lblLabels 
         Caption         =   "Email:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   16
         Left            =   6600
         TabIndex        =   30
         Top             =   1560
         Width           =   2055
      End
   End
End
Attribute VB_Name = "frmPerfis"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Dim WithEvents adoPrimaryRS As Recordset
Attribute adoPrimaryRS.VB_VarHelpID = -1
Dim mbChangedByCode As Boolean
Dim mvBookMark As Variant
Dim mbEditFlag As Boolean
Dim mbAddNewFlag As Boolean
Dim mbDataChanged As Boolean
Public pesID As Integer
Public findPES As String
Option Explicit
Private Declare Function URLDownloadToFile Lib "urlmon" Alias "URLDownloadToFileA" (ByVal pCaller As Long, ByVal szURL As String, ByVal szFileName As String, ByVal dwReserved As Long, ByVal lpfnCB As Long) As Long

Private Sub cmdReprov_Click()
    With frmMotivo
        .mFlag = 0
        .Show vbModal, Me
    End With
End Sub

Private Sub Combo1_click()
 txtFields(0).Text = Combo1.ListIndex
 If Combo1.ListIndex = 2 Then
    frmMotivo.Show vbModal, Me
 ElseIf Combo1.ListIndex = 1 Then
    txtFields(12).Text = ""
 End If
End Sub

Private Sub Comprovacao_Click()
    With frmImage
        .Image1.Picture = Comprovacao.Picture
        .Show
    End With
End Sub

Private Sub Documento_Click()
    With frmImage
        .Image1.Picture = Documento.Picture
        .Show
    End With
End Sub

Private Sub Form_Load()
  Dim db As Connection
  Dim flagSql As String
  Set db = New Connection
  
  db.CursorLocation = adUseClient
  db.Open "PROVIDER=MSDataShape;Data PROVIDER=MSDASQL;driver={MySQL ODBC 5.3 Unicode Driver};" & _
          "server=" & GetSetting(App.Title, "CFGSYS", "CFGHOST") & ";" & _
          "uid=" & GetSetting(App.Title, "CFGSYS", "CFGUSER") & ";" & _
          "pwd=" & GetSetting(App.Title, "CFGSYS", "CFGPASS") & ";" & _
          "database=" & GetSetting(App.Title, "CFGSYS", "CFGDATA") & ";"

  If pesID > 0 Then
    flagSql = "pesid = " & pesID
  ElseIf findPES <> "" Then
    flagSql = "(pesid = '" & findPES & "' OR cpf = '" & findPES & "' OR email = '" & findPES & "' OR url = '" & findPES & "')"
  Else
    flagSql = "aprovado = 0"
  End If
  
  Set adoPrimaryRS = New Recordset
    adoPrimaryRS.Open "SELECT " & _
                      "pesid, whatsapp, tel1, tel2, email, lido, mensagem, " & _
                      "CONCAT(ROUND(DATEDIFF(now(), nascimento) / 365), ' ANOS') AS idade, " & _
                      "url, rg, cpf, nascimento, " & _
                      "CASE WHEN sexo = 'M' THEN 'MASCULINO' " & _
                      "WHEN sexo = 'F' THEN 'FEMININO' " & _
                      "WHEN sexo = 'T' THEN 'TRANSGENERO' END AS sexo, " & _
                      "CASE WHEN aprovado = 0 THEN 'AGUARDANDO' " & _
                      "WHEN aprovado = 1 THEN 'APROVADO' " & _
                      "WHEN aprovado = 2 THEN 'REPROVADO' END AS status_aprovado, " & _
                      "nome, cadastro, apelido, aprovado, documento, comprovacao " & _
                      "FROM pessoas " & _
                      "WHERE " & flagSql & " ORDER BY cadastro ASC", db, adOpenStatic, adLockOptimistic

  Dim oText As TextBox
  Dim oLabel As Label
  
  For Each oText In Me.txtFields
    Set oText.DataSource = adoPrimaryRS
    oText.Enabled = False
  Next
  
  For Each oLabel In Me.lblLabels
     oLabel.Enabled = False
  Next
  
  Set lblIdade.DataSource = adoPrimaryRS
  Set lblAprovado.DataSource = adoPrimaryRS
  
  changeImage txtFields(10).Text, txtFields(2).Text, txtFields(11).Text

  mbDataChanged = False
  
  If adoPrimaryRS.RecordCount = 0 And findPES <> "" Then
    MsgBox "Nenhum anunciante encontrado com estes termos de pesquisa!", vbInformation
  End If
  
  If lblAprovado.Caption = "APROVADO" Then
    cmdEdit.Enabled = False
  End If
  If GetSetting(App.Title, "CFGSYS", "PROFILE") = "operator" Then
    cmdRemove.Enabled = False
  End If
  
End Sub

Private Sub Form_KeyDown(KeyCode As Integer, Shift As Integer)
  If mbEditFlag Or mbAddNewFlag Then Exit Sub

  Select Case KeyCode
    Case vbKeyEnd
      cmdLast_Click
    Case vbKeyHome
      cmdFirst_Click
    Case vbKeyUp, vbKeyPageUp
      If Shift = vbCtrlMask Then
        cmdFirst_Click
      Else
        cmdPrevious_Click
      End If
    Case vbKeyDown, vbKeyPageDown
      If Shift = vbCtrlMask Then
        cmdLast_Click
      Else
        cmdNext_Click
      End If
  End Select
End Sub

Private Sub Form_Unload(Cancel As Integer)
  Screen.MousePointer = vbDefault
End Sub

Private Sub adoPrimaryRS_WillChangeRecord(ByVal adReason As ADODB.EventReasonEnum, ByVal cRecords As Long, adStatus As ADODB.EventStatusEnum, ByVal pRecordset As ADODB.Recordset)
  Dim bCancel As Boolean
  Select Case adReason
  Case adRsnAddNew
  Case adRsnClose
  Case adRsnDelete
  Case adRsnFirstChange
  Case adRsnMove
  Case adRsnRequery
  Case adRsnResynch
  Case adRsnUndoAddNew
  Case adRsnUndoDelete
  Case adRsnUndoUpdate
  Case adRsnUpdate
  End Select

  If bCancel Then adStatus = adStatusCancel
End Sub

Private Sub cmdRefresh_Click()
  'This is only needed for multi user apps
  On Error GoTo RefreshErr
  adoPrimaryRS.Requery
  changeImage txtFields(10).Text, txtFields(2).Text, txtFields(11).Text
  Exit Sub
RefreshErr:
  MsgBox Err.Description
End Sub

Private Sub cmdEdit_Click()
  Dim oText As TextBox
  Dim oLabel As Label
  On Error GoTo EditErr
  frmForm.Enabled = True
  For Each oText In Me.txtFields
    oText.Enabled = True
  Next
  For Each oLabel In Me.lblLabels
    oLabel.Enabled = True
  Next
  mbEditFlag = True
  SetButtons False
  Exit Sub
EditErr:
  MsgBox Err.Description
End Sub
Private Sub cmdCancel_Click()
  On Error Resume Next
  SetButtons True
  mbEditFlag = False
  mbAddNewFlag = False
  adoPrimaryRS.CancelUpdate
  If mvBookMark > 0 Then
    adoPrimaryRS.Bookmark = mvBookMark
  Else
    adoPrimaryRS.MoveFirst
  End If
  mbDataChanged = False
End Sub

Private Sub cmdUpdate_Click()
  On Error GoTo UpdateErr
  adoPrimaryRS.UpdateBatch adAffectAll
  If mbAddNewFlag Then
    adoPrimaryRS.MoveLast
  End If
  mbEditFlag = False
  mbAddNewFlag = False
  SetButtons True
  mbDataChanged = False
  cmdFirst_Click
  MsgBox "Perfil alterado com sucesso!", , App.Title
  Unload Me
  Exit Sub
UpdateErr:
  MsgBox Err.Description
End Sub

Private Sub cmdFirst_Click()
  On Error GoTo GoFirstError
  adoPrimaryRS.MoveFirst
  mbDataChanged = False
  changeImage txtFields(10).Text, txtFields(2).Text, txtFields(11).Text
  Exit Sub
GoFirstError:
  MsgBox Err.Description
End Sub

Private Sub cmdLast_Click()
  On Error GoTo GoLastError
  adoPrimaryRS.MoveLast
  mbDataChanged = False
  changeImage txtFields(10).Text, txtFields(2).Text, txtFields(11).Text
  Exit Sub
GoLastError:
  MsgBox Err.Description
End Sub

Private Sub cmdNext_Click()
  On Error GoTo GoNextError
  If Not adoPrimaryRS.EOF Then adoPrimaryRS.MoveNext
  If adoPrimaryRS.EOF And adoPrimaryRS.RecordCount > 0 Then
    Beep
    adoPrimaryRS.MoveLast
  End If
  mbDataChanged = False
  changeImage txtFields(10).Text, txtFields(2).Text, txtFields(11).Text
  Exit Sub
GoNextError:
  MsgBox Err.Description
End Sub

Private Sub cmdPrevious_Click()
  On Error GoTo GoPrevError
  If Not adoPrimaryRS.BOF Then adoPrimaryRS.MovePrevious
  If adoPrimaryRS.BOF And adoPrimaryRS.RecordCount > 0 Then
    Beep
    adoPrimaryRS.MoveFirst
  End If
  mbDataChanged = False
  changeImage txtFields(10).Text, txtFields(2).Text, txtFields(11).Text
  Exit Sub
GoPrevError:
  MsgBox Err.Description
End Sub

Private Sub SetButtons(bVal As Boolean)
  cmdEdit.Visible = bVal
  cmdUpdate.Visible = Not bVal
  cmdCancel.Visible = Not bVal
  cmdRefresh.Visible = bVal
  cmdNext.Enabled = bVal
  cmdFirst.Enabled = bVal
  cmdLast.Enabled = bVal
  cmdPrevious.Enabled = bVal
End Sub

Function changeImage(pes As String, doc As String, cpr As String)
'Debug.Print GetSetting(App.Title, "CFGSYS", "CFGSITE") & pes & "/" & cpr
 On Local Error GoTo error
    Dim strDocSaveAs As String
    Dim strCprSaveAs As String
    Dim lonReturn1 As Long
    Dim lonReturn2 As Long
    strDocSaveAs = App.Path & "\documento-atual1.jpeg"
    strCprSaveAs = App.Path & "\comprovacao-atual1.jpeg"
    lonReturn1 = URLDownloadToFile(0, GetSetting(App.Title, "CFGSYS", "CFGSITE") & pes & "/" & doc, strDocSaveAs, 0, 0)
    lonReturn2 = URLDownloadToFile(0, GetSetting(App.Title, "CFGSYS", "CFGSITE") & pes & "/" & cpr, strCprSaveAs, 0, 0)
    Set Documento.Picture = LoadPicture(strDocSaveAs)
    Set Comprovacao.Picture = LoadPicture(strCprSaveAs)
error:
    Debug.Print Err.Description & lonReturn1
End Function

Private Sub lblAprovado_Change()
    If lblAprovado.Caption = "APROVADO" Then
        lblAprovado.ForeColor = &HC000&
        Combo1.Enabled = False
        cmdReprov.Enabled = False
        txtFields(12).Enabled = False
        lblLabels(12).Enabled = False
    ElseIf lblAprovado.Caption = "REPROVADO" Then
        txtFields(12).Enabled = True
        lblLabels(12).Enabled = True
        lblAprovado.ForeColor = &HC0&
    Else
        Combo1.Enabled = True
        cmdReprov.Enabled = True
        txtFields(12).Enabled = False
        lblLabels(12).Enabled = False
        lblAprovado.ForeColor = &H80&
    End If
End Sub
