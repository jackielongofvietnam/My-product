namespace TicTacToe
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.pnlBoard = new System.Windows.Forms.FlowLayoutPanel();
            this.lblTurn = new System.Windows.Forms.Label();
            this.lblPlayer = new System.Windows.Forms.Label();
            this.SuspendLayout();
            // 
            // pnlBoard
            // 
            this.pnlBoard.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(128)))), ((int)(((byte)(255)))), ((int)(((byte)(255)))));
            this.pnlBoard.Location = new System.Drawing.Point(10, 10);
            this.pnlBoard.Margin = new System.Windows.Forms.Padding(1);
            this.pnlBoard.Name = "pnlBoard";
            this.pnlBoard.Padding = new System.Windows.Forms.Padding(1);
            this.pnlBoard.Size = new System.Drawing.Size(922, 697);
            this.pnlBoard.TabIndex = 0;
            // 
            // lblTurn
            // 
            this.lblTurn.AutoSize = true;
            this.lblTurn.Font = new System.Drawing.Font("Microsoft Sans Serif", 30F);
            this.lblTurn.Location = new System.Drawing.Point(1019, 203);
            this.lblTurn.Name = "lblTurn";
            this.lblTurn.Size = new System.Drawing.Size(112, 46);
            this.lblTurn.TabIndex = 1;
            this.lblTurn.Text = "Turn:";
            // 
            // lblPlayer
            // 
            this.lblPlayer.AutoSize = true;
            this.lblPlayer.Font = new System.Drawing.Font("Microsoft Sans Serif", 30F);
            this.lblPlayer.Location = new System.Drawing.Point(1156, 203);
            this.lblPlayer.Name = "lblPlayer";
            this.lblPlayer.Size = new System.Drawing.Size(135, 46);
            this.lblPlayer.TabIndex = 2;
            this.lblPlayer.Text = "(none)";
            this.lblPlayer.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(1350, 729);
            this.Controls.Add(this.lblPlayer);
            this.Controls.Add(this.lblTurn);
            this.Controls.Add(this.pnlBoard);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.Name = "Form1";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Tic Tac Toe";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.FlowLayoutPanel pnlBoard;
        private System.Windows.Forms.Label lblTurn;
        private System.Windows.Forms.Label lblPlayer;
    }
}

