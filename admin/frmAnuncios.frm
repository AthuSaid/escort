VERSION 5.00
Begin VB.Form frmAnuncios 
   BorderStyle     =   3  'Fixed Dialog
   Caption         =   "Aprova��o de An�ncios"
   ClientHeight    =   8985
   ClientLeft      =   45
   ClientTop       =   390
   ClientWidth     =   10950
   BeginProperty Font 
      Name            =   "Tahoma"
      Size            =   9.75
      Charset         =   0
      Weight          =   400
      Underline       =   0   'False
      Italic          =   0   'False
      Strikethrough   =   0   'False
   EndProperty
   Icon            =   "frmAnuncios.frx":0000
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   MinButton       =   0   'False
   ScaleHeight     =   8985
   ScaleWidth      =   10950
   StartUpPosition =   2  'CenterScreen
   Begin VB.Frame frmForm 
      Enabled         =   0   'False
      Height          =   8295
      Left            =   240
      TabIndex        =   9
      Top             =   120
      Width           =   10455
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
         ItemData        =   "frmAnuncios.frx":000C
         Left            =   360
         List            =   "frmAnuncios.frx":0019
         Style           =   2  'Dropdown List
         TabIndex        =   16
         Top             =   5520
         Width           =   2775
      End
      Begin VB.TextBox txtFields 
         DataField       =   "titulo"
         Height          =   285
         Index           =   0
         Left            =   360
         TabIndex        =   12
         Top             =   1800
         Width           =   4935
      End
      Begin VB.TextBox txtFields 
         DataField       =   "pesid"
         Height          =   285
         Index           =   9
         Left            =   720
         TabIndex        =   26
         Top             =   1800
         Width           =   1095
      End
      Begin VB.TextBox txtRecords 
         DataField       =   "pesid"
         Height          =   285
         Index           =   9
         Left            =   3840
         TabIndex        =   25
         Top             =   1800
         Width           =   495
      End
      Begin VB.TextBox txtFields 
         DataField       =   "aprovado"
         Height          =   285
         Index           =   6
         Left            =   1800
         TabIndex        =   24
         Top             =   5520
         Width           =   375
      End
      Begin VB.TextBox txtFields 
         DataField       =   "descricao"
         BeginProperty Font 
            Name            =   "Courier New"
            Size            =   9
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   1095
         Index           =   1
         Left            =   360
         MultiLine       =   -1  'True
         ScrollBars      =   2  'Vertical
         TabIndex        =   23
         Top             =   2400
         Width           =   9735
      End
      Begin VB.TextBox txtFields 
         DataField       =   "url"
         Height          =   285
         Index           =   2
         Left            =   5400
         TabIndex        =   22
         Top             =   1800
         Width           =   4695
      End
      Begin VB.TextBox txtFields 
         DataField       =   "pessoasatendimento"
         Height          =   285
         Index           =   3
         Left            =   360
         TabIndex        =   21
         Top             =   4800
         Width           =   3735
      End
      Begin VB.TextBox txtFields 
         DataField       =   "idiomas"
         Height          =   285
         Index           =   4
         Left            =   4200
         TabIndex        =   20
         Top             =   4800
         Width           =   2895
      End
      Begin VB.TextBox txtFields 
         DataField       =   "visitascount"
         Height          =   285
         Index           =   5
         Left            =   7200
         TabIndex        =   19
         Top             =   4800
         Width           =   2895
      End
      Begin VB.CommandButton cmdReprov 
         Caption         =   "Reprova��o"
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
         TabIndex        =   18
         Top             =   5520
         Width           =   1335
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
         Left            =   4560
         MultiLine       =   -1  'True
         TabIndex        =   17
         Top             =   5520
         Width           =   3615
      End
      Begin VB.ListBox galeria 
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   12
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         ForeColor       =   &H8000000D&
         Height          =   1770
         Left            =   360
         TabIndex        =   15
         Top             =   6240
         Width           =   9735
      End
      Begin VB.TextBox txtFields 
         DataField       =   "apid"
         Height          =   285
         Index           =   7
         Left            =   1440
         TabIndex        =   14
         Top             =   1800
         Width           =   495
      End
      Begin VB.TextBox txtRecords 
         DataField       =   "urlpes"
         Height          =   285
         Index           =   8
         Left            =   2040
         TabIndex        =   13
         Top             =   1800
         Width           =   495
      End
      Begin VB.CommandButton cmdPerfil 
         Caption         =   "..."
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
         Left            =   5880
         TabIndex        =   11
         Top             =   600
         Width           =   375
      End
      Begin VB.TextBox txtModalidadesCache 
         DataField       =   "pessoasatendimento"
         BeginProperty Font 
            Name            =   "Courier New"
            Size            =   9
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   645
         Left            =   360
         MultiLine       =   -1  'True
         ScrollBars      =   2  'Vertical
         TabIndex        =   10
         Top             =   3840
         Width           =   9735
      End
      Begin VB.Label lblLabels 
         Caption         =   "T�tulo:"
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
         Index           =   0
         Left            =   360
         TabIndex        =   50
         Top             =   1560
         Width           =   1935
      End
      Begin VB.Label lblLabels 
         Caption         =   "Descri��o:"
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
         Index           =   1
         Left            =   360
         TabIndex        =   49
         Top             =   2160
         Width           =   1935
      End
      Begin VB.Label lblLabels 
         Caption         =   "URL Amig�vel:"
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
         Index           =   2
         Left            =   5400
         TabIndex        =   48
         Top             =   1560
         Width           =   1935
      End
      Begin VB.Label lblLabels 
         Caption         =   "Pessoas que Atende:"
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
         TabIndex        =   47
         Top             =   4560
         Width           =   2775
      End
      Begin VB.Label lblLabels 
         Caption         =   "Idiomas:"
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
         Left            =   4200
         TabIndex        =   46
         Top             =   4560
         Width           =   2775
      End
      Begin VB.Label lblLabels 
         Caption         =   "Anunciante:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   11.25
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   5
         Left            =   360
         TabIndex        =   45
         Top             =   360
         Width           =   1455
      End
      Begin VB.Label lblRecords 
         BackStyle       =   0  'Transparent
         Caption         =   "TESTE"
         DataField       =   "nome"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         ForeColor       =   &H00000040&
         Height          =   255
         Index           =   1
         Left            =   375
         TabIndex        =   44
         Top             =   840
         Width           =   5895
      End
      Begin VB.Label lblLabels 
         Caption         =   "N� Visitas:"
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
         Index           =   6
         Left            =   7200
         TabIndex        =   43
         Top             =   4560
         Width           =   2775
      End
      Begin VB.Label lblLabels 
         Caption         =   "Telefones de Contato:"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   11.25
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   7
         Left            =   6480
         TabIndex        =   42
         Top             =   360
         Width           =   2175
      End
      Begin VB.Label lblRecords 
         Caption         =   "TESTE"
         DataField       =   "whatsapp"
         ForeColor       =   &H00000000&
         Height          =   255
         Index           =   2
         Left            =   7920
         TabIndex        =   41
         Top             =   600
         Width           =   2175
      End
      Begin VB.Label lblRecords 
         Caption         =   "TESTE"
         DataField       =   "tel1"
         ForeColor       =   &H00000000&
         Height          =   255
         Index           =   3
         Left            =   7920
         TabIndex        =   40
         Top             =   840
         Width           =   2175
      End
      Begin VB.Label lblRecords 
         Caption         =   "TESTE"
         DataField       =   "tel2"
         ForeColor       =   &H00000000&
         Height          =   255
         Index           =   4
         Left            =   7920
         TabIndex        =   39
         Top             =   1080
         Width           =   2175
      End
      Begin VB.Label lblLabels 
         Caption         =   "WhatsApp:"
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
         Index           =   8
         Left            =   6480
         TabIndex        =   38
         Top             =   600
         Width           =   1095
      End
      Begin VB.Label lblLabels 
         Caption         =   "Telefone 1:"
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
         Left            =   6480
         TabIndex        =   37
         Top             =   840
         Width           =   1095
      End
      Begin VB.Label lblLabels 
         Caption         =   "Telefone 2:"
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
         Index           =   10
         Left            =   6480
         TabIndex        =   36
         Top             =   1080
         Width           =   1215
      End
      Begin VB.Label lblLabels 
         Caption         =   "E-mail:"
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
         Top             =   1080
         Width           =   735
      End
      Begin VB.Label lblRecords 
         Caption         =   "TESTE"
         DataField       =   "email"
         ForeColor       =   &H00000000&
         Height          =   255
         Index           =   5
         Left            =   1080
         TabIndex        =   34
         Top             =   1080
         Width           =   5175
      End
      Begin VB.Label lblLabels 
         Caption         =   "Motivo Reprova��o:"
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
         Left            =   4560
         TabIndex        =   33
         Top             =   5280
         Width           =   2415
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
         Index           =   13
         Left            =   360
         TabIndex        =   32
         Top             =   5280
         Width           =   1935
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
         Left            =   8280
         TabIndex        =   31
         Top             =   5520
         Width           =   1935
      End
      Begin VB.Label lblLabels 
         Caption         =   "Status do An�ncio:"
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
         Index           =   14
         Left            =   8280
         TabIndex        =   30
         Top             =   5280
         Width           =   1935
      End
      Begin VB.Label lblRecords 
         BackStyle       =   0  'Transparent
         Caption         =   "TESTE"
         DataField       =   "apelido"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         ForeColor       =   &H8000000D&
         Height          =   255
         Index           =   0
         Left            =   360
         TabIndex        =   29
         Top             =   600
         Width           =   4815
      End
      Begin VB.Label lblLabels 
         BackStyle       =   0  'Transparent
         Caption         =   "Galeria de Fotos do An�ncio (clique no item para visualizar a imagem):"
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
         Index           =   17
         Left            =   360
         TabIndex        =   28
         Top             =   6000
         Width           =   8895
      End
      Begin VB.Label lblLabels 
         Caption         =   "Modalidades && Cach�:"
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
         Index           =   15
         Left            =   360
         TabIndex        =   27
         Top             =   3600
         Width           =   2775
      End
   End
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
      ScaleWidth      =   10950
      TabIndex        =   0
      Top             =   8565
      Width           =   10950
      Begin VB.CommandButton cmdRemove 
         Caption         =   "&REMOVER AN�NCIO"
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
         Left            =   5280
         TabIndex        =   51
         Top             =   0
         Width           =   2295
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
         Left            =   7680
         TabIndex        =   8
         Top             =   0
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
         Left            =   9600
         TabIndex        =   7
         Top             =   0
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
         Left            =   7680
         TabIndex        =   6
         Top             =   0
         Visible         =   0   'False
         Width           =   1815
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
         Left            =   9600
         TabIndex        =   5
         Top             =   0
         Visible         =   0   'False
         Width           =   1095
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
         Picture         =   "frmAnuncios.frx":0062
         Style           =   1  'Graphical
         TabIndex        =   4
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
         Picture         =   "frmAnuncios.frx":03A4
         Style           =   1  'Graphical
         TabIndex        =   3
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
         Picture         =   "frmAnuncios.frx":06E6
         Style           =   1  'Graphical
         TabIndex        =   2
         Top             =   0
         UseMaskColor    =   -1  'True
         Width           =   345
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
         Picture         =   "frmAnuncios.frx":0A28
         Style           =   1  'Graphical
         TabIndex        =   1
         Top             =   0
         UseMaskColor    =   -1  'True
         Width           =   345
      End
   End
End
Attribute VB_Name = "frmAnuncios"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Dim WithEvents adoPrimaryRS As Recordset
Attribute adoPrimaryRS.VB_VarHelpID = -1
Dim WithEvents adoModalities As Recordset
Attribute adoModalities.VB_VarHelpID = -1
Dim WithEvents adoCaches As Recordset
Attribute adoCaches.VB_VarHelpID = -1
Dim WithEvents adoGallery As Recordset
Attribute adoGallery.VB_VarHelpID = -1
Dim WithEvents adoPerson As Recordset
Attribute adoPerson.VB_VarHelpID = -1
Dim mbChangedByCode As Boolean
Dim mvBookMark As Variant
Dim mbEditFlag As Boolean
Dim mbAddNewFlag As Boolean
Dim mbDataChanged As Boolean
Dim db As Connection
Public findAD As String
Option Explicit
Private Declare Function URLDownloadToFile Lib "urlmon" Alias "URLDownloadToFileA" (ByVal pCaller As Long, ByVal szURL As String, ByVal szFileName As String, ByVal dwReserved As Long, ByVal lpfnCB As Long) As Long

Private Sub cmdRemove_Click()
    If MsgBox("Deseja remover este an�ncio permanentemente?", vbYesNo + vbQuestion) = vbYes Then
        db.Execute "UPDATE anuncios_pessoas SET removido = 1 WHERE apid = " & txtFields(7).Text
        MsgBox "An�ncio removido com sucesso!"
        Unload Me
    End If
End Sub

Private Sub cmdReprov_Click()
    With frmMotivo
        .mFlag = 1
        .Show vbModal, Me
    End With
End Sub

Private Sub Combo1_click()
 txtFields(6).Text = Combo1.ListIndex
 If Combo1.ListIndex = 2 Then
    frmMotivo.Show vbModal, Me
 ElseIf Combo1.ListIndex = 1 Then
    txtFields(12).Text = ""
 End If
End Sub

Private Sub cmdPerfil_Click()
    With frmPerfis
        .pesID = txtFields(9).Text
        .Show
    End With
End Sub

Private Sub Form_Load()
  Dim flagSql As String
  Dim oText As TextBox
  Dim oLabel As Label
  
  Set db = New Connection
  db.CursorLocation = adUseClient
  db.Open "PROVIDER=MSDataShape;Data PROVIDER=MSDASQL;driver={MySQL ODBC 5.3 Unicode Driver};" & _
          "server=" & GetSetting(App.Title, "CFGSYS", "CFGHOST") & ";" & _
          "uid=" & GetSetting(App.Title, "CFGSYS", "CFGUSER") & ";" & _
          "pwd=" & GetSetting(App.Title, "CFGSYS", "CFGPASS") & ";" & _
          "database=" & GetSetting(App.Title, "CFGSYS", "CFGDATA") & ";"

  Set adoPrimaryRS = New Recordset
  
  If findAD <> "" Then
    flagSql = "(ap.apid = '" & findAD & "' OR ap.titulo = '" & findAD & "' OR ap.url = '" & findAD & "')"
  Else
    flagSql = "ap.aprovado = 0"
  End If
  
  adoPrimaryRS.Open "SELECT " & _
                        "ap.*, " & _
                        "CASE WHEN ap.aprovado = 0 THEN 'AGUARDANDO' WHEN ap.aprovado = 1 THEN 'APROVADO' WHEN ap.aprovado = 2 THEN 'REPROVADO' END AS status_aprovado " & _
                     "FROM anuncios_pessoas ap " & _
                     "WHERE " & flagSql & " ORDER BY ap.cadastro ASC ", db, adOpenStatic, adLockOptimistic

  For Each oText In Me.txtFields
    Set oText.DataSource = adoPrimaryRS
    oText.Enabled = False
  Next
  
  For Each oLabel In Me.lblLabels
    oLabel.Enabled = False
  Next
  
  Set lblAprovado.DataSource = adoPrimaryRS
  
  updatePerson
  updateGallery
  updateModalitiesCaches

    If lblAprovado.Caption = "APROVADO" Then
      cmdEdit.Enabled = False
    End If
    If GetSetting(App.Title, "CFGSYS", "PROFILE") = "operator" Then
      cmdRemove.Enabled = False
    End If


  mbDataChanged = False
End Sub

Function updatePerson()
  Dim oLabel As Label
  Dim oText As TextBox
  Set adoPerson = New Recordset
     adoPerson.Open "SELECT " & _
                        "p.pesid, p.url AS urlpes, p.apelido, p.nome, p.email, p.whatsapp, p.tel1, p.tel2 " & _
                     "FROM anuncios_pessoas ap " & _
                     "INNER JOIN pessoas p ON p.pesid = ap.pesid " & _
                     "WHERE ap.apid = " & txtFields(7).Text, db, adOpenStatic, adLockOptimistic

  For Each oLabel In Me.lblRecords
    Set oLabel.DataSource = adoPerson
  Next
  For Each oText In Me.txtRecords
    Set oText.DataSource = adoPerson
  Next
End Function

Function updateGallery()
  Set adoGallery = New Recordset
     adoGallery.Open "SELECT " & _
                        "pf.* " & _
                     "FROM pessoas_fotos pf " & _
                     "WHERE pf.apid = " & txtFields(7).Text & " AND pf.tipo = 2", db, adOpenStatic, adLockOptimistic

  With galeria
    .Clear
    Do While Not adoGallery.EOF
      .AddItem adoGallery(3)
      adoGallery.MoveNext
    Loop
  End With
End Function

Function updateModalitiesCaches()
  txtModalidadesCache.Text = ""
  Set adoModalities = New Recordset
    adoModalities.Open "SELECT " & _
                          "mo.* " & _
                       "FROM modalidades_pessoas mp " & _
                       "INNER JOIN modalidades mo ON mo.modid = mp.modid " & _
                       "WHERE mp.apid = " & txtFields(7).Text & " AND mo.ativo = 1", db, adOpenStatic, adLockOptimistic
                     
  Set adoCaches = New Recordset
    adoCaches.Open "SELECT " & _
                          "pc.* " & _
                       "FROM pessoas_cache pc " & _
                       "WHERE pc.apid = " & txtFields(7).Text, db, adOpenStatic, adLockOptimistic
                     
 With txtModalidadesCache
    Do While Not adoModalities.EOF
      .Text = .Text & adoModalities(2) & " - "
      adoModalities.MoveNext
    Loop
  End With
  
  txtModalidadesCache.Text = txtModalidadesCache.Text & vbCrLf & _
  "30min: " & Format(adoCaches(3), "##0.00") & " " & _
  "1H: " & Format(adoCaches(4), "##0.00") & " " & _
  "2H: " & Format(adoCaches(5), "##0.00") & " " & _
  "4H: " & Format(adoCaches(6), "##0.00") & " " & _
  "8H: " & Format(adoCaches(7), "##0.00") & " " & _
  "Pernoite: " & Format(adoCaches(8), "##0.00") & " " & _
  "Viagens: " & Format(adoCaches(9), "##0.00")
End Function

Private Sub adoPrimaryRS_WillChangeRecord(ByVal adReason As ADODB.EventReasonEnum, ByVal cRecords As Long, adStatus As ADODB.EventStatusEnum, ByVal pRecordset As ADODB.Recordset)
  'This is where you put validation code
  'This event gets called when the following actions occur
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
  adoGallery.Requery
  adoModalities.Requery
  adoCaches.Requery
  adoPerson.Requery
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
  MsgBox "An�ncio alterado com sucesso!", , App.Title
  Unload Me
  Exit Sub
UpdateErr:
  MsgBox Err.Description
End Sub

Private Sub cmdClose_Click()
  Unload Me
End Sub

Private Sub cmdFirst_Click()
  On Error GoTo GoFirstError

  adoPrimaryRS.MoveFirst
  mbDataChanged = False
  updateGallery
  updateModalitiesCaches
  updatePerson
  Exit Sub

GoFirstError:
  MsgBox Err.Description
End Sub

Private Sub cmdLast_Click()
  On Error GoTo GoLastError

  adoPrimaryRS.MoveLast
  mbDataChanged = False
  updateGallery
  updateModalitiesCaches
  updatePerson
  Exit Sub

GoLastError:
  MsgBox Err.Description
End Sub

Private Sub cmdNext_Click()
  On Error GoTo GoNextError

  If Not adoPrimaryRS.EOF Then
    adoPrimaryRS.MoveNext
    updateGallery
    updateModalitiesCaches
    updatePerson
  End If
  If adoPrimaryRS.EOF And adoPrimaryRS.RecordCount > 0 Then
    Beep
    adoPrimaryRS.MoveLast
    updateGallery
    updateModalitiesCaches
    updatePerson
  End If
  mbDataChanged = False
  Exit Sub
GoNextError:
  MsgBox Err.Description
End Sub

Private Sub cmdPrevious_Click()
  On Error GoTo GoPrevError

  If Not adoPrimaryRS.BOF Then
    adoPrimaryRS.MovePrevious
    updateGallery
    updateModalitiesCaches
    updatePerson
  End If
  If adoPrimaryRS.BOF And adoPrimaryRS.RecordCount > 0 Then
    Beep
    adoPrimaryRS.MoveFirst
    updateGallery
    updateModalitiesCaches
    updatePerson
  End If
  mbDataChanged = False
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

Function LoadGallery(pes As String, Gallery As String)
 On Local Error Resume Next
    Dim strGalSaveAs As String
    Dim lonReturn1 As Long
    strGalSaveAs = App.Path & "\galeria_atual.jpg"
    lonReturn1 = URLDownloadToFile(0, GetSetting(App.Title, "CFGSYS", "CFGSITE") & pes & "/" & Gallery, strGalSaveAs, 0, 0)
     With frmImage
        .Image1.Picture = LoadPicture(strGalSaveAs)
        .Show
    End With
End Function

Private Sub galeria_Click()
    Dim img As String
    img = galeria.List(galeria.ListIndex)
    LoadGallery txtRecords(8).Text, img
End Sub

