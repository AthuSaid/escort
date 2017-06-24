VERSION 5.00
Begin VB.Form frmImpressao 
   BorderStyle     =   3  'Fixed Dialog
   Caption         =   "Impressão de Relatórios"
   ClientHeight    =   3045
   ClientLeft      =   45
   ClientTop       =   375
   ClientWidth     =   4365
   BeginProperty Font 
      Name            =   "Tahoma"
      Size            =   8.25
      Charset         =   0
      Weight          =   400
      Underline       =   0   'False
      Italic          =   0   'False
      Strikethrough   =   0   'False
   EndProperty
   Icon            =   "frmImpressao.frx":0000
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   MinButton       =   0   'False
   Moveable        =   0   'False
   ScaleHeight     =   3045
   ScaleWidth      =   4365
   ShowInTaskbar   =   0   'False
   StartUpPosition =   2  'CenterScreen
   Begin VB.CommandButton cmdAbrir 
      Caption         =   "&Abrir"
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
      Left            =   1320
      TabIndex        =   0
      Top             =   2520
      Width           =   1755
   End
   Begin VB.OptionButton optRel 
      Caption         =   "Receita e Despesa"
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
      Index           =   4
      Left            =   360
      TabIndex        =   5
      Top             =   1800
      Width           =   3855
   End
   Begin VB.OptionButton optRel 
      Caption         =   "Anúncios Rejeitados"
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
      Index           =   3
      Left            =   360
      TabIndex        =   4
      Top             =   1440
      Width           =   3855
   End
   Begin VB.OptionButton optRel 
      Caption         =   "Anúncios Ativos"
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
      Index           =   2
      Left            =   360
      TabIndex        =   3
      Top             =   1080
      Width           =   3855
   End
   Begin VB.OptionButton optRel 
      Caption         =   "Perfis Rejeitados"
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
      Index           =   1
      Left            =   360
      TabIndex        =   2
      Top             =   720
      Width           =   3855
   End
   Begin VB.OptionButton optRel 
      Caption         =   "Perfis Ativos"
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
      Index           =   0
      Left            =   360
      TabIndex        =   1
      Tag             =   "rptRelatorio"
      Top             =   360
      Width           =   3855
   End
End
Attribute VB_Name = "frmImpressao"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Dim rel As String
Private Sub cmdAbrir_Click()
    If rel = Empty Then
        MsgBox "Selecione o relatório que deseja visualizar!"
    Else
        If rel = "rptRelatorio" Then rptRelatorio.Show vbModal
        If rel = "rptPInativos" Then rptPInativos.Show vbModal
        If rel = "rptAnuncios" Then rptAnuncios.Show vbModal
        If rel = "rptAInativos" Then rptAInativos.Show vbModal
        If rel = "rptReceitaDespesa" Then rptReceitaDespesa.Show vbModal
    End If
End Sub

Private Sub optRel_Click(Index As Integer)
    rel = optRel(Index).Tag
End Sub
