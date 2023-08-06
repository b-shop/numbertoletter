class ChiffreEnLettre {
  private static $chiffres = array(
    0 => 'zéro',
    1 => 'un',
    2 => 'deux',
    3 => 'trois',
    4 => 'quatre',
    5 => 'cinq',
    6 => 'six',
    7 => 'sept',
    8 => 'huit',
    9 => 'neuf',
    10 => 'dix',
    11 => 'onze',
    12 => 'douze',
    13 => 'treize',
    14 => 'quatorze',
    15 => 'quinze',
    16 => 'seize',
    20 => 'vingt',
    30 => 'trente',
    40 => 'quarante',
    50 => 'cinquante',
    60 => 'soixante',
    70 => 'soixante-dix',
    80 => 'quatre-vingt',
    90 => 'quatre-vingt-dix'
  );

  public static function convertir($chiffre) {
    if ($chiffre < 0 || $chiffre > 999999999) {
      throw new InvalidArgumentException("Le chiffre doit être compris entre 0 et 999 999 999.");
    }

    if ($chiffre == 0) {
      return self::$chiffres[0];
    }

    $resultat = '';

    if ($chiffre >= 1000000) {
      $millions = floor($chiffre / 1000000);
      $resultat .= self::convertir($millions) . ' million' . ($millions > 1 ? 's' : '') . ' ';
      $chiffre %= 1000000;
    }

    if ($chiffre >= 1000) {
      $milliers = floor($chiffre / 1000);
      $resultat .= self::convertir($milliers) . ' mille ';
      $chiffre %= 1000;
    }

    if ($chiffre >= 100) {
      $centaines = floor($chiffre / 100);
      $resultat .= self::$chiffres[$centaines] . ' cent ';
      $chiffre %= 100;
    }

    if ($chiffre >= 10 && $chiffre <= 16) {
      $resultat .= self::$chiffres[$chiffre];
    } else if ($chiffre == 70 || $chiffre == 90) {
      $resultat .= self::$chiffres[$chiffre - 10] . 's';
    } else if ($chiffre >= 17 && $chiffre <= 69 || $chiffre >= 71 && $chiffre <= 89) {
      $dizaines = floor($chiffre / 10) * 10;
      $resultat .= self::$chiffres[$dizaines];
      $chiffre %= 10;

      if ($chiffre > 0) {
        $resultat .= '-';
      }
    }

    if ($chiffre >= 1 && $chiffre <= 9) {
      $resultat .= self::$chiffres[$chiffre];
    }

    return $resultat;
  }
}
