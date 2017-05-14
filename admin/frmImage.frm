VERSION 5.00
Begin VB.Form frmImage 
   Caption         =   "Ampliar Imagem"
   ClientHeight    =   6255
   ClientLeft      =   120
   ClientTop       =   465
   ClientWidth     =   7605
   Icon            =   "frmImage.frx":0000
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   ScaleHeight     =   6255
   ScaleWidth      =   7605
   ShowInTaskbar   =   0   'False
   StartUpPosition =   2  'CenterScreen
   Begin VB.Image Image1 
      Height          =   6255
      Left            =   0
      Stretch         =   -1  'True
      Top             =   0
      Width           =   7575
   End
End
Attribute VB_Name = "frmImage"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Sub Form_Resize()
    Image1.Width = Me.Width
    Image1.Height = Me.Height
End Sub
