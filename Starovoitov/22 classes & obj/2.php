<?php ## ����� ������ �������.
  require_once "Math/Complex1.php";
  // ������� ������ ������.
  $a = new MathComplex1;
  $a->re = 314;
  $a->im = 101;
  // ������� ������ ������.
  $b = new MathComplex1;
  $b->re = 303;
  $b->im = 6;
  // ��������� ���� �������� � �������.
  $a->add($b);
  // ������� ���������:
  echo $a->__toString();
?>