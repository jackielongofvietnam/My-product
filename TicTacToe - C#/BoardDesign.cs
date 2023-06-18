using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Drawing;

namespace TicTacToe
{  
    public class BoardDesign
    {       
        private FlowLayoutPanel _board;
        private X_Player _X;
        private O_Player _O;
        private Label _playerLabel;
        private int _playerTurn;
        private List<List<Button>> _buttonList;
        public BoardDesign(FlowLayoutPanel board, Label playerLabel)
        {
            _board = board;
            _X = new X_Player();
            _O = new O_Player();
            _playerLabel = playerLabel;
            _playerLabel.Font = new Font(_X.Font.FontFamily, 30);
            _playerLabel.ForeColor = _X.FontColor;
            _playerLabel.Text = _X.PlayerID;
            _playerTurn = 0;
            _buttonList = new List<List<Button>>();  
        }       
        public void DrawBoard()
        {          
            for (int i = 0; i < Cons.BOARD_VERTICAL_CELL_COUNT; i++)
            {
                _buttonList.Add(new List<Button>());
                for (int j = 0; j < Cons.BOARD_HORIZONTAL_CELL_COUNT; j++)
                {
                    Button btn = new Button() { Width = Cons.CELL_WIDTH, 
                                                Height = Cons.CELL_HEIGHT, 
                                                BackColor = Cons.CELL_COLOR,
                                                Tag = i.ToString()};
                    btn.Click += btn_Click;
                    _board.Controls.Add(btn);
                    _buttonList[i].Add(btn);
                }
            }
        }
        private void btn_Click(object sender, EventArgs e)
        {          
            Button btn = sender as Button;
            if (btn.Text == "") 
            {
                if (_playerTurn % 2 == 0)
                {
                    PlayerChange(btn, _X, _O, _playerLabel);
                }
                else
                {
                    PlayerChange(btn, _O, _X, _playerLabel);
                }
            }
            if (IsWin(btn)) //check win condition
            {               
                DialogResult result = MessageBox.Show($"Congratulation! Player {((_playerLabel.Text == "X")? 'O' : 'X')} won the game. Would you like to play again?", 
                                "Game Over", 
                                MessageBoxButtons.YesNo, 
                                MessageBoxIcon.Information);              
                if (result == DialogResult.Yes) { Application.Restart(); }
                else { Application.Exit(); }
            }
            if (_playerTurn == Cons.CELL_COUNT) //End when all buttons are filled
            {
                _playerLabel.Font = new Font("Arial", 30);
                _playerLabel.ForeColor = Color.Black;
                _playerLabel.Text = "(none)";
                DialogResult result = MessageBox.Show("Draw! Do you want to play again?", 
                                                      "Well done", 
                                                      MessageBoxButtons.YesNo, 
                                                      MessageBoxIcon.Information);
                if (result == DialogResult.Yes) { Application.Restart(); }
                else { Application.Exit(); }
            }                    
        }
        private void PlayerChange(Button btn, Player current, Player next, Label playerLabel)
        {
            btn.Font = current.Font;
            btn.ForeColor = current.FontColor;
            btn.Text = current.PlayerID;
            _playerLabel.Font = new Font(next.Font.FontFamily, 30);
            _playerLabel.ForeColor = next.FontColor;
            _playerLabel.Text = next.PlayerID;
            _playerTurn++;          
        }
        private bool IsWin(Button btn) // check 4 win conditions, return true if one of them is met
        {         
            return IsWinHorizontal(btn) || IsWinVertical(btn) || IsWinDiagonal_1(btn) || IsWinDiagonal_2(btn);
        }
        private bool IsWinHorizontal(Button btn) //check win condition horizontally
        {          
            int i = Convert.ToInt32(btn.Tag);
            int j = _buttonList[i].IndexOf(btn);
            int counter = 0;          
            for (int a = 0; a < 5; a++)
            {
                if (j + a == Cons.BOARD_HORIZONTAL_CELL_COUNT) { break; } //if index is out of range, break the loop
                if (btn.Text == _buttonList[i][j + a].Text) { counter++; } //if right neighboring button's text is identical, add 1 to counter
                else { break; } //if encounter a different button's text, break the loop
            }
            for (int a = 0; a < 5; a++)
            {
                if (j - a < 0) { break; } //if index is out of range, break the loop
                if (btn.Text == _buttonList[i][j - a].Text) { counter++; } //if left neighboring button's text is identical, add 1 to counter
                else { break; } //if encounter a different button's text, break the loop
            }
            if (counter > 5) { return true; } //if counter is larger than 5, there are 5 adjacently identical button (win condition is met)
            return false;          
        }
        private bool IsWinVertical(Button btn) 
        {
            int i = Convert.ToInt32(btn.Tag);
            int j = _buttonList[i].IndexOf(btn);
            int counter = 0;
            for (int a = 0; a < 5; a++)
            {
                if (i + a == Cons.BOARD_VERTICAL_CELL_COUNT) { break; } 
                if (btn.Text == _buttonList[i + a][j].Text) { counter++; } //if lower neighboring button's text is identical, add 1 to counter
                else { break; }
            }
            for (int a = 0; a < 5; a++)
            {
                if (i - a < 0) { break; } 
                if (btn.Text == _buttonList[i - a][j].Text) { counter++; } //if upper neighboring button's text is identical, add 1 to counter
                else { break; }
            }
            if (counter > 5) { return true; }
            return false; 
        }
        private bool IsWinDiagonal_1(Button btn) 
        {
            int i = Convert.ToInt32(btn.Tag);
            int j = _buttonList[i].IndexOf(btn);
            int counter = 0;
            for (int a = 0; a < 5; a++)
            {
                if (i + a == Cons.BOARD_VERTICAL_CELL_COUNT || j + a == Cons.BOARD_HORIZONTAL_CELL_COUNT) { break; } 
                if (btn.Text == _buttonList[i + a][j + a].Text) { counter++; } //if upper-right neighboring button's text is identical, add 1 to counter
                else { break; }
            }
            for (int a = 0; a < 5; a++)
            {
                if (i - a < 0 || j - a < 0) { break; } 
                if (btn.Text == _buttonList[i - a][j - a].Text) { counter++; } //if lower-left neighboring button's text is identical, add 1 to counter
                else { break; }
            }          
            if (counter > 5) { return true; }
            return false; 
        }
        private bool IsWinDiagonal_2(Button btn)
        {
            int i = Convert.ToInt32(btn.Tag);
            int j = _buttonList[i].IndexOf(btn);
            int counter = 0;          
            for (int a = 0; a < 5; a++)
            {
                if (i + a == Cons.BOARD_VERTICAL_CELL_COUNT || j - a < 0) { break; } 
                if (btn.Text == _buttonList[i + a][j - a].Text) { counter++; } //if lower-left neighboring button's text is identical, add 1 to counter
                else { break; }
            }
            for (int a = 0; a < 5; a++)
            {
                if (i - a < 0 || j + a == Cons.BOARD_HORIZONTAL_CELL_COUNT) { break; } 
                if (btn.Text == _buttonList[i - a][j + a].Text) { counter++; } //if upper-right neighboring button's text is identical, add 1 to counter
                else { break; }
            }
            if (counter > 5) { return true; }
            return false;
        }
    }
}
