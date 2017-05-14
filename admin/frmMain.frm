VERSION 5.00
Begin VB.Form Form1 
   BorderStyle     =   1  'Fixed Single
   Caption         =   "Libidinous - Administração de Conteúdo"
   ClientHeight    =   8550
   ClientLeft      =   45
   ClientTop       =   390
   ClientWidth     =   12870
   BeginProperty Font 
      Name            =   "Tahoma"
      Size            =   8.25
      Charset         =   0
      Weight          =   400
      Underline       =   0   'False
      Italic          =   0   'False
      Strikethrough   =   0   'False
   EndProperty
   Icon            =   "frmMain.frx":0000
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   ScaleHeight     =   8550
   ScaleWidth      =   12870
   StartUpPosition =   2  'CenterScreen
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Option Explicit
Dim sql As String

Public myCon As New ADODB.Connection
Public myCmd As New ADODB.Command
Public myRS As New ADODB.Recordset

Private Sub Form_Load()
On Error GoTo Error

sql = "SELECT * FROM planos"
'myCon.Open "DSN=MySQLConexao"
myCon.Open "Driver={MySQL ODBC 5.3 Unicode Driver};Server=localhost;Database=escort; User=root;Password=;Option=3;"


With myCmd
      Set .ActiveConnection = myCon
      .CommandType = adCmdText
      .CommandText = sql
End With

With myRS
   .LockType = adLockPessimistic
   .CursorType = adOpenKeyset
   .CursorLocation = adUseClient
   .Open myCmd
End With

myRS.MoveFirst
'MostraNumeroRegistro
'Mostra_dados

On Error GoTo 0

Form_Load_Exit:
Exit Sub

Error:
MsgBox Err.Number & vbCrLf & Err.Description, vbExclamation, "Erro em [Form_Load]"
End Sub
