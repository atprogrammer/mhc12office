<html>
<header>
<title>pdf</title>
<meta http-equiv="Content-Language" content="th" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
  @font-face{
   font-family:  'THSarabunNew';
   font-style: normal;
   font-weight: normal;
   src: url("{{asset('fonts/THSarabunNew.ttf') }}") format('truetype');
  }
  @font-face{
   font-family:  'THSarabunNew';
   font-style: normal;
   font-weight: bold;
   src: url("{{asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
  }
  @font-face{
   font-family:  'THSarabunNew';
   font-style: italic;
   font-weight: normal;
   src: url("{{asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
  }
  @font-face{
   font-family:  'THSarabunNew';
   font-style: italic;
   font-weight: bold;
   src: url("{{asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
  }
  body{
   font-family: "THSarabunNew";
   font-size: 18px;
  }
  @page {
        size: A4;
        padding: 15px;
      }
      @media print {
        html, body {
          width: 210mm;
          height: 297mm;
          /*font-size : 16px;*/
        }
      }



#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}


p.dotted {border-style: dotted;}
p.dashed {border-style: dashed;}
p.solid {border-style: solid;}
p.double {border-style: double;}
p.groove {border-style: groove;}
p.ridge {border-style: ridge;}
p.inset {border-style: inset;}
p.outset {border-style: outset;}
p.none {border-style: none;}
p.hidden {border-style: hidden;}
p.mix {border-style: dotted dashed solid double;}
  </style>
</header>
<body>
  <img src="https://www.w3schools.com/images/w3schools_green.jpg" alt="W3Schools.com" style="width:104px;height:142px;">
  <center>
<h1>Header</h1>
  </center>
<br>

<table id="customers">
  <tr>
    <th>ไทย</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  <tr>
    <td>ไทย</td>
    <td>Maria Anders</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Berglunds snabbköp</td>
    <td>Christina Berglund</td>
    <td>Sweden</td>
  </tr>
  <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
  <tr>
    <td>Ernst Handel</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr>
  <tr>
    <td>Island Trading</td>
    <td>Helen Bennett</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Königlich Essen</td>
    <td>Philip Cramer</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Yoshi Tannamuri</td>
    <td>Canada</td>
  </tr>
  <tr>
    <td>Magazzini Alimentari Riuniti</td>
    <td>Giovanni Rovelli</td>
    <td>Italy</td>
  </tr>
  <tr>
    <td>North/South</td>
    <td>Simon Crowther</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Paris spécialités</td>
    <td>Marie Bertrand</td>
    <td>France</td>
  </tr>
</table>

<h2>The border-style Property</h2>
<p>This property specifies what kind of border to display:</p>

<p class="dotted">A dotted border.</p>
<p class="dashed">A dashed border.</p>
<p class="solid">A solid border.</p>
<p class="double">A double border.</p>
<p class="groove">A groove border.</p>
<p class="ridge">A ridge border.</p>
<p class="inset">An inset border.</p>
<p class="outset">An outset border.</p>
<p class="none">No border.</p>
<p class="hidden">A hidden border.</p>
<p class="mix">A mixed border.</p>

<p>Insert an image from another folder:</p>
<img src="/images/stickman.gif" alt="Stickman" width="24" height="39">

<p>Insert an image from a web site:</p>
<img src="https://www.w3schools.com/images/lamp.jpg" alt="Lamp" width="32" height="32">

</body>
</html>