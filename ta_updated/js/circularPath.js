function posisiFinalX(jumlahGroup, sourcex, i, finalX, finalY) {
	var miring = 75 * 0.7;		

	if(jumlahGroup == 2) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcex + 75;
			} else if(i == 1) {
				return sourcex + miring;
			}
		}
		// Atas
		else if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcex + miring;
			} else if(i == 1) {
				return sourcex;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex - miring;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex - miring;
			} else if(i == 1) {
				return sourcex - 75;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcex - 75;
			} else if(i == 1) {
				return sourcex - miring;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcex - miring;
			} else if(i == 1) {
				return sourcex;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + miring;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex + miring;
			} else if(i == 1) {
				return sourcex + 75;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + miring;
			}
		}
	}
	
	if(jumlahGroup == 3) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcex + 75;
			} else if(i == 1) {
				return sourcex + miring;
			} else if(i == 2) {
				return sourcex;
			}
		}
		// Atas
		else if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcex + miring;
			} else if(i == 1) {
				return sourcex;
			} else if(i == 2) {
				return sourcex - miring;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex - miring;
			} else if(i == 2) {
				return sourcex - 75;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex - miring;
			} else if(i == 1) {
				return sourcex - 75;
			} else if(i == 2) {
				return sourcex - miring;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcex - 75;
			} else if(i == 1) {
				return sourcex - miring;
			} else if(i == 2) {
				return sourcex;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcex - miring;
			} else if(i == 1) {
				return sourcex;
			} else if(i == 2) {
				return sourcex + miring;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + miring;
			} else if(i == 2) {
				return sourcex + 75;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex + miring;
			} else if(i == 1) {
				return sourcex + 75;
			} else if(i == 2) {
				return sourcex + miring;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + miring;
			} else if(i == 2) {
				return sourcex + 75;
			}
		}
	}
	
	if(jumlahGroup == 4) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcex + 120;
			} else if(i == 1) {
				return sourcex + 100;
			} else if(i == 2) {
				return sourcex + 55;
			} else if(i == 3) {
				return sourcex;
			}
		}
		// Atas
		if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcex + 75;
			} else if(i == 1) {
				return sourcex + miring;
			} else if(i == 2) {
				return sourcex;
			} else if(i == 3) {
				return sourcex - miring;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcex - 120;
			} else if(i == 1) {
				return sourcex - 100;
			} else if(i == 2) {
				return sourcex - 55;
			} else if(i == 3) {
				return sourcex;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex - miring;
			} else if(i == 2) {
				return sourcex - 75;
			} else if(i == 3) {
				return sourcex - miring;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcex - 120;
			} else if(i == 1) {
				return sourcex - 100;
			} else if(i == 2) {
				return sourcex - 55;
			} else if(i == 3) {
				return sourcex;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcex - 75;
			} else if(i == 1) {
				return sourcex - miring;
			} else if(i == 2) {
				return sourcex;
			} else if(i == 3) {
				return sourcex + miring;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + 55;
			} else if(i == 2) {
				return sourcex + 100;
			} else if(i == 3) {
				return sourcex + 120;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + miring;
			} else if(i == 2) {
				return sourcex + 75;
			} else if(i == 3) {
				return sourcex + miring;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + miring;
			} else if(i == 2) {
				return sourcex + 75;
			} else if(i == 3) {
				return sourcex + miring;
			}
		}
	}
	
	if(jumlahGroup == 5) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcex + 130;
			} else if(i == 1) {
				return sourcex + 120;
			} else if(i == 2) {
				return sourcex + 91;
			} else if(i == 3) {
				return sourcex + 50;
			} else if(i == 4) {
				return sourcex;
			}
		}
		// Atas
		if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcex + 75;
			} else if(i == 1) {
				return sourcex + miring;
			} else if(i == 2) {
				return sourcex;
			} else if(i == 3) {
				return sourcex - miring;
			} else if(i == 4) {
				return sourcex - 75;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcex - 130;
			} else if(i == 1) {
				return sourcex - 120;
			} else if(i == 2) {
				return sourcex - 91;
			} else if(i == 3) {
				return sourcex - 50;
			} else if(i == 4) {
				return sourcex;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex - miring;
			} else if(i == 2) {
				return sourcex - 75;
			} else if(i == 3) {
				return sourcex - miring;
			} else if(i == 4) {
				return sourcex;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcex - 130;
			} else if(i == 1) {
				return sourcex - 120;
			} else if(i == 2) {
				return sourcex - 91;
			} else if(i == 3) {
				return sourcex - 50;
			} else if(i == 4) {
				return sourcex;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcex - 75;
			} else if(i == 1) {
				return sourcex - miring;
			} else if(i == 2) {
				return sourcex;
			} else if(i == 3) {
				return sourcex + miring;
			} else if(i == 4) {
				return sourcex + 75;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + 50;
			} else if(i == 2) {
				return sourcex + 91;
			} else if(i == 3) {
				return sourcex + 120;
			} else if(i == 4) {
				return sourcex + 130;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + miring;
			} else if(i == 2) {
				return sourcex + 75;
			} else if(i == 3) {
				return sourcex + miring;
			} else if(i == 4) {
				return sourcex;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + miring;
			} else if(i == 2) {
				return sourcex + 75;
			} else if(i == 3) {
				return sourcex + miring;
			} else if(i == 4) {
				return sourcex;
			}
		}
	}
	
	if(jumlahGroup == 6) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcex + 160;
			} else if(i == 1) {
				return sourcex + 145;
			} else if(i == 2) {
				return sourcex + 125;
			} else if(i == 3) {
				return sourcex + 90;
			} else if(i == 4) {
				return sourcex + 45;
			} else if(i == 5) {
				return sourcex;
			}
		}
		// Atas
		if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcex + 100;
			} else if(i == 1) {
				return sourcex + 70;
			} else if(i == 2) {
				return sourcex + 30;
			} else if(i == 3) {
				return sourcex - 30 ;
			} else if(i == 4) {
				return sourcex - 70;
			} else if(i == 5) {
				return sourcex - 100;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcex - 160;
			} else if(i == 1) {
				return sourcex - 145;
			} else if(i == 2) {
				return sourcex - 125;
			} else if(i == 3) {
				return sourcex - 90;
			} else if(i == 4) {
				return sourcex - 45;
			} else if(i == 5) {
				return sourcex;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex - 50;
			} else if(i == 2) {
				return sourcex - 90;
			} else if(i == 3) {
				return sourcex - 90;
			} else if(i == 4) {
				return sourcex - 50;
			} else if(i == 5) {
				return sourcex;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcex - 160;
			} else if(i == 1) {
				return sourcex - 145;
			} else if(i == 2) {
				return sourcex - 125;
			} else if(i == 3) {
				return sourcex - 90;
			} else if(i == 4) {
				return sourcex - 45;
			} else if(i == 5) {
				return sourcex;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcex - 100;
			} else if(i == 1) {
				return sourcex - 70;
			} else if(i == 2) {
				return sourcex - 30;
			} else if(i == 3) {
				return sourcex + 30 ;
			} else if(i == 4) {
				return sourcex + 70;
			} else if(i == 5) {
				return sourcex + 100;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + 45;
			} else if(i == 2) {
				return sourcex + 90;
			} else if(i == 3) {
				return sourcex + 125;
			} else if(i == 4) {
				return sourcex + 145;
			} else if(i == 5) {
				return sourcex + 160;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + 50;
			} else if(i == 2) {
				return sourcex + 90;
			} else if(i == 3) {
				return sourcex + 90;
			} else if(i == 4) {
				return sourcex + 50;
			} else if(i == 5) {
				return sourcex;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + miring;
			} else if(i == 2) {
				return sourcex + 75;
			} else if(i == 3) {
				return sourcex + miring;
			} else if(i == 4) {
				return sourcex;
			} else if(i == 5) {
				return sourcex - miring;
			}
		}
	}

	if(jumlahGroup == 7) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcex + 200;
			} else if(i == 1) {
				return sourcex + 195;
			} else if(i == 2) {
				return sourcex + 175;
			} else if(i == 3) {
				return sourcex + 140;
			} else if(i == 4) {
				return sourcex + 100;
			} else if(i == 5) {
				return sourcex + 50;
			} else if(i == 6) {
				return sourcex;
			}
		}
		// Atas
		if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcex + 120;
			} else if(i == 1) {
				return sourcex + 100;
			} else if(i == 2) {
				return sourcex + 60;
			} else if(i == 3) {
				return sourcex;
			} else if(i == 4) {
				return sourcex - 60 ;
			} else if(i == 5) {
				return sourcex - 100;
			} else if(i == 6) {
				return sourcex - 120;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcex - 200;
			} else if(i == 1) {
				return sourcex - 195;
			} else if(i == 2) {
				return sourcex - 175;
			} else if(i == 3) {
				return sourcex - 140;
			} else if(i == 4) {
				return sourcex - 100;
			} else if(i == 5) {
				return sourcex - 50;
			} else if(i == 6) {
				return sourcex;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex - 55;
			} else if(i == 2) {
				return sourcex - 100;
			} else if(i == 3) {
				return sourcex - 120;
			} else if(i == 4) {
				return sourcex - 100 ;
			} else if(i == 5) {
				return sourcex - 55;
			} else if(i == 6) {
				return sourcex;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcex - 200;
			} else if(i == 1) {
				return sourcex - 195;
			} else if(i == 2) {
				return sourcex - 175;
			} else if(i == 3) {
				return sourcex - 140;
			} else if(i == 4) {
				return sourcex - 100;
			} else if(i == 5) {
				return sourcex - 50;
			} else if(i == 6) {
				return sourcex;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcex - 120;
			} else if(i == 1) {
				return sourcex - 100;
			} else if(i == 2) {
				return sourcex - 60;
			} else if(i == 3) {
				return sourcex;
			} else if(i == 4) {
				return sourcex + 60 ;
			} else if(i == 5) {
				return sourcex + 100;
			} else if(i == 6) {
				return sourcex + 120;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + 50;
			} else if(i == 2) {
				return sourcex + 100;
			} else if(i == 3) {
				return sourcex + 140;
			} else if(i == 4) {
				return sourcex + 175;
			} else if(i == 5) {
				return sourcex + 195;
			} else if(i == 6) {
				return sourcex + 200;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + 55;
			} else if(i == 2) {
				return sourcex + 100;
			} else if(i == 3) {
				return sourcex + 120;
			} else if(i == 4) {
				return sourcex + 100 ;
			} else if(i == 5) {
				return sourcex + 55;
			} else if(i == 6) {
				return sourcex;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + miring;
			} else if(i == 2) {
				return sourcex + 75;
			} else if(i == 3) {
				return sourcex + miring;
			} else if(i == 4) {
				return sourcex;
			} else if(i == 5) {
				return sourcex - miring;
			} else if(i == 6) {
				return sourcex - 75;
			}
		}
	}
	
	if(jumlahGroup == 8) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcex + 230;
			} else if(i == 1) {
				return sourcex + 225;
			} else if(i == 2) {
				return sourcex + 210;
			} else if(i == 3) {
				return sourcex + 180;
			} else if(i == 4) {
				return sourcex + 145;
			} else if(i == 5) {
				return sourcex + 100;
			} else if(i == 6) {
				return sourcex + 50;
			} else if(i == 7) {
				return sourcex;
			}
		}
		// Atas
		if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcex + 140;
			} else if(i == 1) {
				return sourcex + 120;
			} else if(i == 2) {
				return sourcex + 80;
			} else if(i == 3) {
				return sourcex + 30;
			} else if(i == 4) {
				return sourcex - 30;
			} else if(i == 5) {
				return sourcex - 80;
			} else if(i == 6) {
				return sourcex - 120;
			} else if(i == 7) {
				return sourcex - 140;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcex - 230;
			} else if(i == 1) {
				return sourcex - 225;
			} else if(i == 2) {
				return sourcex - 210;
			} else if(i == 3) {
				return sourcex - 180;
			} else if(i == 4) {
				return sourcex - 145;
			} else if(i == 5) {
				return sourcex - 100;
			} else if(i == 6) {
				return sourcex - 50;
			} else if(i == 7) {
				return sourcex;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex - 55;
			} else if(i == 2) {
				return sourcex - 100;
			} else if(i == 3) {
				return sourcex - 130;
			} else if(i == 4) {
				return sourcex - 130;
			} else if(i == 5) {
				return sourcex - 100;
			} else if(i == 6) {
				return sourcex - 55;
			} else if(i == 7) {
				return sourcex;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcex - 230;
			} else if(i == 1) {
				return sourcex - 225;
			} else if(i == 2) {
				return sourcex - 210;
			} else if(i == 3) {
				return sourcex - 180;
			} else if(i == 4) {
				return sourcex - 145;
			} else if(i == 5) {
				return sourcex - 100;
			} else if(i == 6) {
				return sourcex - 50;
			} else if(i == 7) {
				return sourcex;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcex - 140;
			} else if(i == 1) {
				return sourcex - 120;
			} else if(i == 2) {
				return sourcex - 80;
			} else if(i == 3) {
				return sourcex - 30;
			} else if(i == 4) {
				return sourcex + 30;
			} else if(i == 5) {
				return sourcex + 80;
			} else if(i == 6) {
				return sourcex + 120;
			} else if(i == 7) {
				return sourcex + 140;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + 50;
			} else if(i == 2) {
				return sourcex + 100;
			} else if(i == 3) {
				return sourcex + 145;
			} else if(i == 4) {
				return sourcex + 180;
			} else if(i == 5) {
				return sourcex + 210;
			} else if(i == 6) {
				return sourcex + 225;
			} else if(i == 7) {
				return sourcex + 230;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + 55;
			} else if(i == 2) {
				return sourcex + 100;
			} else if(i == 3) {
				return sourcex + 130;
			} else if(i == 4) {
				return sourcex + 130;
			} else if(i == 5) {
				return sourcex + 100;
			} else if(i == 6) {
				return sourcex + 55;
			} else if(i == 7) {
				return sourcex;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcex;
			} else if(i == 1) {
				return sourcex + miring;
			} else if(i == 2) {
				return sourcex + 75;
			} else if(i == 3) {
				return sourcex + miring;
			} else if(i == 4) {
				return sourcex;
			} else if(i == 5) {
				return sourcex - miring;
			} else if(i == 6) {
				return sourcex - 75;
			} else if(i == 7) {
				return sourcex - miring
			}
		}
	}
}

function posisiFinalY(jumlahGroup, sourcey, i, finalX, finalY) {
	var miring = 75 * 0.7;

	if(jumlahGroup == 2) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + miring;
			}
		}
		// Atas
		else if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcey + miring;
			} else if(i == 1) {
				return sourcey + 75;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcey + 75;
			} else if(i == 1) {
				return sourcey + miring;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey + miring;
			} else if(i == 1) {
				return sourcey;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey - miring;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcey - miring;
			} else if(i == 1) {
				return sourcey - 75;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcey - 75;
			} else if(i == 1) {
				return sourcey - miring;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey - miring;
			} else if(i == 1) {
				return sourcey;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcey - 75;
			} else if(i == 1) {
				return sourcey - miring;
			}
		}
	}
	
	if(jumlahGroup == 3) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + miring;
			} else if(i == 2) {
				return sourcey + 75;
			}
		}
		// Atas
		else if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcey + miring;
			} else if(i == 1) {
				return sourcey + 75;
			} else if(i == 2) {
				return sourcey + miring;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcey + 75;
			} else if(i == 1) {
				return sourcey + miring;
			} else if(i == 2) {
				return sourcey;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey + miring;
			} else if(i == 1) {
				return sourcey;
			} else if(i == 2) {
				return sourcey - miring;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey - miring;
			} else if(i == 2) {
				return sourcey - 75;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcey - miring;
			} else if(i == 1) {
				return sourcey - 75;
			} else if(i == 2) {
				return sourcey - miring;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcey - 75;
			} else if(i == 1) {
				return sourcey - miring;
			} else if(i == 2) {
				return sourcey;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey - miring;
			} else if(i == 1) {
				return sourcey;
			} else if(i == 2) {
				return sourcey + miring;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcey - 75;
			} else if(i == 1) {
				return sourcey - miring;
			} else if(i == 2) {
				return sourcey;
			}
		}
	}
	
	if(jumlahGroup == 4) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + 55;
			} else if(i == 2) {
				return sourcey + 100;
			} else if(i == 3) {
				return sourcey + 120;
			}
		}
		// Atas
		if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + miring;
			} else if(i == 2) {
				return sourcey + 75;
			} else if(i == 3) {
				return sourcey + miring;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + 55;
			} else if(i == 2) {
				return sourcey + 100;
			} else if(i == 3) {
				return sourcey + 120;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey + 75;
			} else if(i == 1) {
				return sourcey + miring;
			} else if(i == 2) {
				return sourcey;
			} else if(i == 3) {
				return sourcey - miring;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey - 55;
			} else if(i == 2) {
				return sourcey - 100;
			} else if(i == 3) {
				return sourcey - 120;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey - miring;
			} else if(i == 2) {
				return sourcey - 75;
			} else if(i == 3) {
				return sourcey - miring;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcey - 120;
			} else if(i == 1) {
				return sourcey - 100;
			} else if(i == 2) {
				return sourcey - 55;
			} else if(i == 3) {
				return sourcey;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey - 75;
			} else if(i == 1) {
				return sourcey - miring;
			} else if(i == 2) {
				return sourcey;
			} else if(i == 3) {
				return sourcey + miring;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcey - 75;
			} else if(i == 1) {
				return sourcey - miring;
			} else if(i == 2) {
				return sourcey;
			} else if(i == 3) {
				return sourcey + miring;
			}
		}
	}
	
	if(jumlahGroup == 5) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + 50;
			} else if(i == 2) {
				return sourcey + 91;
			} else if(i == 3) {
				return sourcey + 120;
			} else if(i == 4) {
				return sourcey + 130;
			}
		}
		// Atas
		if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + miring;
			} else if(i == 2) {
				return sourcey + 75;
			} else if(i == 3) {
				return sourcey + miring;
			} else if(i == 4) {
				return sourcey;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + 50;
			} else if(i == 2) {
				return sourcey + 91;
			} else if(i == 3) {
				return sourcey + 120;
			} else if(i == 4) {
				return sourcey + 130;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey + 75;
			} else if(i == 1) {
				return sourcey + miring;
			} else if(i == 2) {
				return sourcey;
			} else if(i == 3) {
				return sourcey - miring;
			} else if(i == 4) {
				return sourcey - 75;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey - 50;
			} else if(i == 2) {
				return sourcey - 91;
			} else if(i == 3) {
				return sourcey - 120;
			} else if(i == 4) {
				return sourcey - 130;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey - miring;
			} else if(i == 2) {
				return sourcey - 75;
			} else if(i == 3) {
				return sourcey - miring;
			} else if(i == 4) {
				return sourcey;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcey - 130;
			} else if(i == 1) {
				return sourcey - 120;
			} else if(i == 2) {
				return sourcey - 91;
			} else if(i == 3) {
				return sourcey - 50;
			} else if(i == 4) {
				return sourcey;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey - 75;
			} else if(i == 1) {
				return sourcey - miring;
			} else if(i == 2) {
				return sourcey;
			} else if(i == 3) {
				return sourcey + miring;
			} else if(i == 4) {
				return sourcey + 75;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcey - 75;
			} else if(i == 1) {
				return sourcey - miring;
			} else if(i == 2) {
				return sourcey;
			} else if(i == 3) {
				return sourcey + miring;
			} else if(i == 4) {
				return sourcey + 75;
			}
		}
	}
	
	if(jumlahGroup == 6) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + 45;
			} else if(i == 2) {
				return sourcey + 90;
			} else if(i == 3) {
				return sourcey + 125;
			} else if(i == 4) {
				return sourcey + 145;
			} else if(i == 5) {
				return sourcey + 160;
			}
		}
		// Atas
		if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + 50;
			} else if(i == 2) {
				return sourcey + 90;
			} else if(i == 3) {
				return sourcey + 90;
			} else if(i == 4) {
				return sourcey + 50;
			} else if(i == 5) {
				return sourcey;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + 45;
			} else if(i == 2) {
				return sourcey + 90;
			} else if(i == 3) {
				return sourcey + 125;
			} else if(i == 4) {
				return sourcey + 145;
			} else if(i == 5) {
				return sourcey + 160;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey + 100;
			} else if(i == 1) {
				return sourcey + 70;
			} else if(i == 2) {
				return sourcey + 30;
			} else if(i == 3) {
				return sourcey - 30;
			} else if(i == 4) {
				return sourcey - 70;
			} else if(i == 5) {
				return sourcey - 100;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey - 45;
			} else if(i == 2) {
				return sourcey - 90;
			} else if(i == 3) {
				return sourcey - 125;
			} else if(i == 4) {
				return sourcey - 145;
			} else if(i == 5) {
				return sourcey - 160;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey - 50;
			} else if(i == 2) {
				return sourcey - 90;
			} else if(i == 3) {
				return sourcey - 90;
			} else if(i == 4) {
				return sourcey - 50;
			} else if(i == 5) {
				return sourcey;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcey - 160;
			} else if(i == 1) {
				return sourcey - 145;
			} else if(i == 2) {
				return sourcey - 125;
			} else if(i == 3) {
				return sourcey - 90;
			} else if(i == 4) {
				return sourcey - 45;
			} else if(i == 5) {
				return sourcey;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey - 100;
			} else if(i == 1) {
				return sourcey - 70;
			} else if(i == 2) {
				return sourcey - 30;
			} else if(i == 3) {
				return sourcey + 30;
			} else if(i == 4) {
				return sourcey + 70;
			} else if(i == 5) {
				return sourcey + 100;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcey - 75;
			} else if(i == 1) {
				return sourcey - miring;
			} else if(i == 2) {
				return sourcey;
			} else if(i == 3) {
				return sourcey + miring;
			} else if(i == 4) {
				return sourcey + 75;
			} else if(i == 5) {
				return sourcey + miring;
			}
		}
	}
	
	if(jumlahGroup == 7) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + 50;
			} else if(i == 2) {
				return sourcey + 100;
			} else if(i == 3) {
				return sourcey + 140;
			} else if(i == 4) {
				return sourcey + 175;
			} else if(i == 5) {
				return sourcey + 195;
			} else if(i == 6) {
				return sourcey + 200;
			}
		}
		// Atas
		if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + 55;
			} else if(i == 2) {
				return sourcey + 100;
			} else if(i == 3) {
				return sourcey + 120;
			} else if(i == 4) {
				return sourcey + 100;
			} else if(i == 5) {
				return sourcey + 55;
			} else if(i == 6) {
				return sourcey;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + 50;
			} else if(i == 2) {
				return sourcey + 100;
			} else if(i == 3) {
				return sourcey + 140;
			} else if(i == 4) {
				return sourcey + 175;
			} else if(i == 5) {
				return sourcey + 195;
			} else if(i == 6) {
				return sourcey + 200;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey + 120;
			} else if(i == 1) {
				return sourcey + 100;
			} else if(i == 2) {
				return sourcey + 60;
			} else if(i == 3) {
				return sourcey;
			} else if(i == 4) {
				return sourcey - 60;
			} else if(i == 5) {
				return sourcey - 100;
			} else if(i == 6) {
				return sourcey - 120;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey - 50;
			} else if(i == 2) {
				return sourcey - 100;
			} else if(i == 3) {
				return sourcey - 140;
			} else if(i == 4) {
				return sourcey - 175;
			} else if(i == 5) {
				return sourcey - 195;
			} else if(i == 6) {
				return sourcey - 200;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey - 55;
			} else if(i == 2) {
				return sourcey - 100;
			} else if(i == 3) {
				return sourcey - 120;
			} else if(i == 4) {
				return sourcey - 100;
			} else if(i == 5) {
				return sourcey - 55;
			} else if(i == 6) {
				return sourcey;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcey - 200;
			} else if(i == 1) {
				return sourcey - 195;
			} else if(i == 2) {
				return sourcey - 175;
			} else if(i == 3) {
				return sourcey - 140;
			} else if(i == 4) {
				return sourcey - 100;
			} else if(i == 5) {
				return sourcey - 50;
			} else if(i == 6) {
				return sourcey;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey - 120;
			} else if(i == 1) {
				return sourcey - 100;
			} else if(i == 2) {
				return sourcey - 60;
			} else if(i == 3) {
				return sourcey;
			} else if(i == 4) {
				return sourcey + 60;
			} else if(i == 5) {
				return sourcey + 100;
			} else if(i == 6) {
				return sourcey + 120;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcey - 75;
			} else if(i == 1) {
				return sourcey - miring;
			} else if(i == 2) {
				return sourcey;
			} else if(i == 3) {
				return sourcey + miring;
			} else if(i == 4) {
				return sourcey + 75;
			} else if(i == 5) {
				return sourcey + miring;
			} else if(i == 6) {
				return sourcey;
			}				
		}
	}
	
	if(jumlahGroup == 8) {
		// Kiri atas
		if(finalX <= 50 && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + 50 ;
			} else if(i == 2) {
				return sourcey + 100;
			} else if(i == 3) {
				return sourcey + 145;
			} else if(i == 4) {
				return sourcey + 180;
			} else if(i == 5) {
				return sourcey + 210;
			} else if(i == 6) {
				return sourcey + 225;
			} else if(i == 7) {
				return sourcey + 230;
			}
		}
		// Atas
		if((finalX >= 50 && finalX <= 700) && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + 55;
			} else if(i == 2) {
				return sourcey + 100;
			} else if(i == 3) {
				return sourcey + 130;
			} else if(i == 4) {
				return sourcey + 130;
			} else if(i == 5) {
				return sourcey + 100;
			} else if(i == 6) {
				return sourcey + 55;
			} else if(i == 7) {
				return sourcey;
			}
		}
		// Kanan atas
		else if(finalX >= 700 && finalY <= 50) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey + 50 ;
			} else if(i == 2) {
				return sourcey + 100;
			} else if(i == 3) {
				return sourcey + 145;
			} else if(i == 4) {
				return sourcey + 180;
			} else if(i == 5) {
				return sourcey + 210;
			} else if(i == 6) {
				return sourcey + 225;
			} else if(i == 7) {
				return sourcey + 230;
			}
		}
		// Kanan
		else if(finalX >= 600 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey + 140;
			} else if(i == 1) {
				return sourcey + 120;
			} else if(i == 2) {
				return sourcey + 80;
			} else if(i == 3) {
				return sourcey + 30;
			} else if(i == 4) {
				return sourcey - 30;
			} else if(i == 5) {
				return sourcey - 80;
			} else if(i == 6) {
				return sourcey - 120;
			} else if(i == 7) {
				return sourcey - 140;
			}
		}
		// Kanan bawah
		else if(finalX >= 700 && finalY >= 400) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey - 50 ;
			} else if(i == 2) {
				return sourcey - 100;
			} else if(i == 3) {
				return sourcey - 145;
			} else if(i == 4) {
				return sourcey - 180;
			} else if(i == 5) {
				return sourcey - 210;
			} else if(i == 6) {
				return sourcey - 225;
			} else if(i == 7) {
				return sourcey - 230;
			}
		}
		// Bawah
		else if((finalX >= 50 && finalX <= 700) && finalY >= 400) {
			if(i == 0) {
				return sourcey;
			} else if(i == 1) {
				return sourcey - 55;
			} else if(i == 2) {
				return sourcey - 100;
			} else if(i == 3) {
				return sourcey - 130;
			} else if(i == 4) {
				return sourcey - 130;
			} else if(i == 5) {
				return sourcey - 100;
			} else if(i == 6) {
				return sourcey - 55;
			} else if(i == 7) {
				return sourcey;
			}
		}
		// Kiri bawah
		else if(finalX <= 50 && finalY >= 400) {
			if(i == 0) {
				return sourcey - 230;
			} else if(i == 1) {
				return sourcey - 225;
			} else if(i == 2) {
				return sourcey - 210;
			} else if(i == 3) {
				return sourcey - 180;
			} else if(i == 4) {
				return sourcey - 145;
			} else if(i == 5) {
				return sourcey - 100;
			} else if(i == 6) {
				return sourcey - 50;
			} else if(i == 7) {
				return sourcey;
			}
		}
		// Kiri
		else if(finalX <= 50 && (finalY >= 50 && finalY <= 400)) {
			if(i == 0) {
				return sourcey - 140;
			} else if(i == 1) {
				return sourcey - 120;
			} else if(i == 2) {
				return sourcey - 80;
			} else if(i == 3) {
				return sourcey - 30;
			} else if(i == 4) {
				return sourcey + 30;
			} else if(i == 5) {
				return sourcey + 80;
			} else if(i == 6) {
				return sourcey + 120;
			} else if(i == 7) {
				return sourcey + 140;
			}
		}
		// Tengah
		else {
			if(i == 0) {
				return sourcey - 75;
			} else if(i == 1) {
				return sourcey - miring;
			} else if(i == 2) {
				return sourcey;
			} else if(i == 3) {
				return sourcey + miring;
			} else if(i == 4) {
				return sourcey + 75;
			} else if(i == 5) {
				return sourcey + miring;
			} else if(i == 6) {
				return sourcey;
			} else if(i == 7) {
				return sourcey - miring
			}
		}
	}
}