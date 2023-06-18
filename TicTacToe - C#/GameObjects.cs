using System;
using System.Collections.Generic;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace TicTacToe
{
    public class Cons
    {
        public const int BOARD_HORIZONTAL_CELL_COUNT = 20;
        public const int BOARD_VERTICAL_CELL_COUNT = 15;
        public const int CELL_WIDTH = 40;
        public const int CELL_HEIGHT = 40;
        public const int CELL_COUNT = BOARD_HORIZONTAL_CELL_COUNT * BOARD_VERTICAL_CELL_COUNT;
        public static Color CELL_COLOR = Color.LightGray;
    }
    public abstract class Player
    {
        private Font _font;
        public Color _fontColor;
        public string _id;
        public Player() 
        {
            _font = new Font("Gill Sans Ultra Bold", 18);
        }
        public Font Font { get { return _font; } }
        public Color FontColor { get { return _fontColor; } }
        public string PlayerID { get { return _id; } } 

    }
    public class X_Player : Player
    {
       public X_Player() : base() 
       {
            _fontColor = Color.Red;
            _id = "X";
       }        
    }
    public class O_Player : Player
    {
        public O_Player() : base()
        {
            _fontColor = Color.Blue;
            _id = "O";
        }
    }
}
