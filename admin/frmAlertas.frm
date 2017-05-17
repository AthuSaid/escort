VERSION 5.00
Begin VB.Form frmAlertas 
   BorderStyle     =   1  'Fixed Single
   Caption         =   "Libidinous - Gerenciamento de Aprovações - Perfis e Anúncios"
   ClientHeight    =   4860
   ClientLeft      =   45
   ClientTop       =   390
   ClientWidth     =   9600
   BeginProperty Font 
      Name            =   "Tahoma"
      Size            =   9.75
      Charset         =   0
      Weight          =   400
      Underline       =   0   'False
      Italic          =   0   'False
      Strikethrough   =   0   'False
   EndProperty
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   ScaleHeight     =   4860
   ScaleWidth      =   9600
   StartUpPosition =   2  'CenterScreen
   Begin VB.PictureBox Picture1 
      BackColor       =   &H00FFFFFF&
      BorderStyle     =   0  'None
      Height          =   1335
      Left            =   0
      ScaleHeight     =   1335
      ScaleWidth      =   9615
      TabIndex        =   6
      Top             =   0
      Width           =   9615
      Begin VB.CommandButton cmdConfig 
         Caption         =   "Config"
         Height          =   375
         Left            =   8160
         TabIndex        =   8
         Top             =   480
         Width           =   975
      End
   End
   Begin VB.Timer piscapisca 
      Interval        =   400
      Left            =   8520
      Top             =   2160
   End
   Begin VB.Timer tempo 
      Interval        =   5000
      Left            =   8040
      Top             =   2160
   End
   Begin VB.CommandButton cmdAnuncios 
      Caption         =   "Ver Anúncios"
      Enabled         =   0   'False
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   7200
      TabIndex        =   5
      Top             =   2880
      Width           =   1815
   End
   Begin VB.CommandButton cmdPerfis 
      Caption         =   "Ver Perfis"
      Enabled         =   0   'False
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   4920
      TabIndex        =   3
      Top             =   2880
      Width           =   1815
   End
   Begin VB.Label lblPerfis 
      Alignment       =   2  'Center
      BackStyle       =   0  'Transparent
      Caption         =   "000"
      DataField       =   "perfis"
      BeginProperty DataFormat 
         Type            =   1
         Format          =   "000"
         HaveTrueFalseNull=   0
         FirstDayOfWeek  =   0
         FirstWeekOfYear =   0
         LCID            =   1046
         SubFormatType   =   0
      EndProperty
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   48
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H8000000D&
      Height          =   1215
      Left            =   4680
      TabIndex        =   0
      Top             =   1680
      Width           =   2175
   End
   Begin VB.Label lblReceita 
      Caption         =   "R$ 0,00"
      DataField       =   "receita"
      BeginProperty DataFormat 
         Type            =   1
         Format          =   """R$"" #.##0,00"
         HaveTrueFalseNull=   0
         FirstDayOfWeek  =   0
         FirstWeekOfYear =   0
         LCID            =   1046
         SubFormatType   =   2
      EndProperty
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   14.25
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   495
      Left            =   1080
      TabIndex        =   7
      Top             =   4200
      Width           =   2295
   End
   Begin VB.Label lblAnuncios 
      Alignment       =   2  'Center
      BackStyle       =   0  'Transparent
      Caption         =   "000"
      DataField       =   "anuncios"
      BeginProperty DataFormat 
         Type            =   1
         Format          =   "000"
         HaveTrueFalseNull=   0
         FirstDayOfWeek  =   0
         FirstWeekOfYear =   0
         LCID            =   1046
         SubFormatType   =   0
      EndProperty
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   48
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H8000000D&
      Height          =   1215
      Left            =   6960
      TabIndex        =   4
      Top             =   1680
      Width           =   2175
   End
   Begin VB.Label lblLabels 
      Caption         =   "Novos Anúncios:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   12
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   1
      Left            =   7200
      TabIndex        =   2
      Top             =   1560
      Width           =   2175
   End
   Begin VB.Label lblLabels 
      Caption         =   "Novos Perfis: "
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   12
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   0
      Left            =   4920
      TabIndex        =   1
      Top             =   1560
      Width           =   1935
   End
End
Attribute VB_Name = "frmAlertas"
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
Option Explicit

Private Sub cmdAnuncios_Click()
    frmAnuncios.Show
End Sub

Private Sub cmdConfig_Click()
    frmCOnfig.Show vbModal, Me
End Sub

Private Sub cmdPerfis_Click()
    frmPerfis.Show
End Sub



Private Sub Form_Load()
Dim db As Connection
  Set db = New Connection
  db.CursorLocation = adUseClient
  db.Open "PROVIDER=MSDataShape;Data PROVIDER=MSDASQL;driver={MySQL ODBC 5.3 Unicode Driver};" & _
          "server=" & GetSetting(App.Title, "CFGSYS", "CFGHOST") & ";" & _
          "uid=" & GetSetting(App.Title, "CFGSYS", "CFGUSER") & ";" & _
          "pwd=" & GetSetting(App.Title, "CFGSYS", "CFGPASS") & ";" & _
          "database=" & GetSetting(App.Title, "CFGSYS", "CFGDATA") & ";"

  Set adoPrimaryRS = New Recordset
  adoPrimaryRS.Open "SELECT " & _
                    "(SELECT COUNT(1) FROM pessoas WHERE aprovado = 0) AS perfis, " & _
                    "(SELECT COUNT(1) FROM pessoas_fotos pf WHERE pf.ativo = 1) AS fotos, " & _
                    "(SELECT SUM(pp.vloriginal) FROM planos_pagamentos pp WHERE pp.pago = 1 AND pp.psid IS NOT NULL AND pp.vencimento > now()) AS receita," & _
                    "(SELECT COUNT(1) FROM anuncios_pessoas WHERE aprovado = 0) AS anuncios", db, adOpenStatic, adLockOptimistic

  Set lblPerfis.DataSource = adoPrimaryRS
  Set lblAnuncios.DataSource = adoPrimaryRS
  Set lblReceita.DataSource = adoPrimaryRS
  mbDataChanged = False
End Sub

Private Sub Form_Unload(Cancel As Integer)
    If MsgBox("Deseja sair do sistema?", vbYesNo + vbQuestion) = vbYes Then
        End
    Else
        Cancel = 5
    End If
End Sub

Private Sub lblAnuncios_Change()
    If lblAnuncios.Caption <> "000" Then
        lblAnuncios.ForeColor = &HC0&
        cmdAnuncios.Enabled = True
    Else
        lblAnuncios.ForeColor = &H8000000D
        cmdAnuncios.Enabled = False
    End If
End Sub

Private Sub lblPerfis_Change()
    If lblPerfis.Caption <> "000" Then
        lblPerfis.ForeColor = &HC0&
        cmdPerfis.Enabled = True
    Else
        lblPerfis.ForeColor = &H8000000D
        cmdPerfis.Enabled = False
    End If
End Sub

Private Sub piscapisca_Timer()
    If lblPerfis.Caption <> "000" Then
        If lblPerfis.Visible = True Then
            lblPerfis.Visible = False
        Else
            lblPerfis.Visible = True
        End If
    Else
        lblPerfis.Visible = True
    End If
    If lblAnuncios.Caption <> "000" Then
        If lblAnuncios.Visible = True Then
            lblAnuncios.Visible = False
        Else
            lblAnuncios.Visible = True
        End If
    Else
        lblAnuncios.Visible = True
    End If
End Sub

Private Sub tempo_Timer()
    adoPrimaryRS.Requery
End Sub
