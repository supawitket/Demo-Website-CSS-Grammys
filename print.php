<?php
    require('assets/fpdf.php');
    require('assets/sql.inc.php');
    
    //print_r($result);

class PDF extends FPDF
{
    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('helvetica','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
    $sqlcmd = "select * from award
                    join presenter on presenter.presenter_id = award.presenter_id
                    join genre on genre.genre_id = award.genre_id
                    join song on song.song_id = award.winner
                    join artist on artist.artist_id = song.artist_id
                    where award_id = ".$_GET['award_id'];
    if($result = $link->query($sqlcmd)->fetch_array(MYSQLI_ASSOC)) {
        
        // Instanciation of inherited class
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->SetFont('helvetica','',20);
        $pdf->Cell(40);
        $pdf->SetLineWidth(2);
        $pdf->Cell(110,15, $result['grammys_id'].'th GRAMMYS AWARD '.$result['award_year'],1,0,'C');
        $pdf->Ln(20);

        $pdf->SetFont('helvetica','',13);
        $pdf->Ln(5);
        $pdf->Cell( 50  , 15 , 'AWARD NAME');
        $pdf->Cell( 50  , 15 , $result['award_name']);
        $pdf->Ln(15);
        $pdf->Cell( 50  , 15 , 'AWARD GENRE');
        $pdf->Cell( 50  , 15 , $result['genre_name']);
        $pdf->Ln(15);
        $pdf->Cell( 50  , 15 , 'PRESENTED BY');
        $pdf->Cell( 50  , 15 , $result['presenter_name']);
        $pdf->Ln(25);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(1);
        $pdf->Line(10,86,200,86);
        $pdf->Cell( 50  , 15 , 'WINNER');
        $pdf->SetFont('helvetica','B',13);
        $pdf->Cell( 50  , 15 , $result['song_title']);
        $pdf->SetFont('helvetica','',13);
        $pdf->Ln(8);
        $pdf->Cell( 50  , 15 , '');
        $pdf->Cell( 50  , 15 , $result['artist_name'].' / '.$result['album'].' / '.$result['artist_label']);
        $pdf->Ln(25);
        $pdf->SetDrawColor(240,240,240);
        $pdf->SetLineWidth(0.5);
        $pdf->Line(10,117,200,117);

        
        $sqlcmd = "select * from nominee
                            join song on song.song_id = nominee.song_id
                            join artist on artist.artist_id = song.artist_id
                            join genre on genre.genre_id = song.genre_id
                            where award_id = ".$_GET['award_id']." and nominee.song_id != '".$result['song_id']."'
                            order by song_title asc";

        $pdf->Cell( 50  , 15 , $link->query($sqlcmd)->num_rows. ' NOMINEES');
        $pdf->Ln(0);

        foreach($link->query($sqlcmd) as $key => $row) { 
            $pdf->Cell( 50  , 15 , '');
            $pdf->SetFont('helvetica','B',13);
            $pdf->Cell( 50  , 15 , $row['song_title']);
            $pdf->SetFont('helvetica','',13);
            $pdf->Ln(8);
            $pdf->Cell( 50  , 15 , '');
            $pdf->Cell( 50  , 15 , $row['artist_name'].' / '.$row['album'].' / '.$row['artist_label']);
            $pdf->Ln(15);
        }


        $pdf->Output();
    }
?>