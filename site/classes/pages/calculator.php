<?php
namespace pages;

class status extends \pages{
  function getContent(){
    //TODO fix this html because, wow, just wow.
    return
    '<CENTER>
    <FORM NAME="Calc">
    <TABLE BORDER="4" bgcolor="#000000" width="790" height="100%" cellspacing="7">
      <TR>
        <TD valign="top" width="330" bordercolor="#000000">
          <TABLE BORDER="1" bgcolor="#000000" width="200" height="320">
            <TR>	
              <TD bordercolor="#000000" colspan="2"><font color="#CCCCCC">Memory Banks:</font></TD>
            </TR>
            <TR>	
              <TD bordercolor="#000000"><font color="#CCCCCC">#1</font></TD>
              <TD bordercolor="#000000" align="center"><input name="bank1" type="text" size="27" maxlength="10000"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value=" C " OnClick="Calc.bank1.value = \'\'"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="M+" OnClick="Calc.bank1.value = Calc.Input.value"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="MR" OnClick="Calc.Input.value += Calc.bank1.value"></TD>
            </TR>
            <TR>	
              <TD bordercolor="#000000"><font color="#CCCCCC">#2</font></TD>
              <TD bordercolor="#000000" align="center"><input name="bank2" type="text" size="27" maxlength="10000"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value=" C " OnClick="Calc.bank2.value = \'\'"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="M+" OnClick="Calc.bank2.value = Calc.Input.value"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="MR" OnClick="Calc.Input.value += Calc.bank2.value"></TD>
            </TR>
            <TR>	
              <TD bordercolor="#000000"><font color="#CCCCCC">#3</font></TD>
              <TD bordercolor="#000000" align="center"><input name="bank3" type="text" size="27" maxlength="10000"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value=" C " OnClick="Calc.bank3.value = \'\'"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="M+" OnClick="Calc.bank3.value = Calc.Input.value"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="MR" OnClick="Calc.Input.value += Calc.bank3.value"></TD>
            </TR>
            <TR>	
              <TD bordercolor="#000000"><font color="#CCCCCC">#4</font></TD>
              <TD bordercolor="#000000" align="center"><input name="bank4" type="text" size="27" maxlength="10000"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value=" C " OnClick="Calc.bank4.value = \'\'"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="M+" OnClick="Calc.bank4.value = Calc.Input.value"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="MR" OnClick="Calc.Input.value += Calc.bank4.value"></TD>
            </TR>
            <TR>	
              <TD bordercolor="#000000"><font color="#CCCCCC">#5</font></TD>
              <TD bordercolor="#000000" align="center"><input name="bank5" type="text" size="27" maxlength="10000"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value=" C " OnClick="Calc.bank5.value = \'\'"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="M+" OnClick="Calc.bank5.value = Calc.Input.value"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="MR" OnClick="Calc.Input.value += Calc.bank5.value"></TD>
            </TR>
            <TR>	
              <TD bordercolor="#000000"><font color="#CCCCCC">#6</font></TD>
              <TD bordercolor="#000000" align="center"><input name="bank6" type="text" size="27" maxlength="10000"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value=" C " OnClick="Calc.bank6.value = \'\'"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="M+" OnClick="Calc.bank6.value = Calc.Input.value"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="MR" OnClick="Calc.Input.value += Calc.bank6.value"></TD>
            </TR>
            <TR>	
              <TD bordercolor="#000000"><font color="#CCCCCC">#7</font></TD>
              <TD bordercolor="#000000" align="center"><input name="bank7" type="text" size="27" maxlength="10000"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value=" C " OnClick="Calc.bank7.value = \'\'"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="M+" OnClick="Calc.bank7.value = Calc.Input.value"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="MR" OnClick="Calc.Input.value += Calc.bank7.value"></TD>
            </TR>
            <TR>	
              <TD bordercolor="#000000"><font color="#CCCCCC">#8</font></TD>
              <TD bordercolor="#000000" align="center"><input name="bank8" type="text" size="27" maxlength="10000"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value=" C " OnClick="Calc.bank8.value = \'\'"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="M+" OnClick="Calc.bank8.value = Calc.Input.value"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="MR" OnClick="Calc.Input.value += Calc.bank8.value"></TD>
            </TR>
            <TR>	
              <TD bordercolor="#000000"><font color="#CCCCCC">#9</font></TD>
              <TD bordercolor="#000000" align="center"><input name="bank9" type="text" size="27" maxlength="10000"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value=" C " OnClick="Calc.bank9.value = \'\'"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="M+" OnClick="Calc.bank9.value = Calc.Input.value"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="MR" OnClick="Calc.Input.value += Calc.bank9.value"></TD>
            </TR>
            <TR>	
              <TD bordercolor="#000000"><font color="#CCCCCC">#10</font></TD>
              <TD bordercolor="#000000" align="center"><input name="bank10" type="text" size="27" maxlength="10000"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value=" C " OnClick="Calc.bank10.value = \'\'"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="M+" OnClick="Calc.bank10.value = Calc.Input.value"></TD>
              <TD bordercolor="#000000" align="center"><input type="button" value="MR" OnClick="Calc.Input.value += Calc.bank10.value"></TD>
            </TR>
          </table>
        </TD>
        <TD bordercolor="#000000" valign="top">
          <table>
            <tr>
              <td colspan="2">
                <TABLE BORDER="1" bgcolor="#000000">
                  <TR>
                    <TD bordercolor="#000000" align="center"><font color="#CCCCCC">Display:</font></TD>
                    <TD bordercolor="#000000" align="center"><INPUT TYPE="text" NAME="Input" Size="50"></TD>
                  </TR>
                </TABLE>
              </td>
            </tr>
            <tr>
              <td width="180">
                <TABLE BORDER="1" bgcolor="#000000">
                  <TR>
                    
                        <TD height="24" colspan="5" align="left" bordercolor="#000000"><font color="#CCCCCC">Keypad:</font></TD>
                  </TR>
                  <TR>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="one"   VALUE="  1  " OnClick="Calc.Input.value += \'1\'"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="two"   VALUE="  2  " OnCLick="Calc.Input.value += \'2\'"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="three" VALUE="  3  " OnClick="Calc.Input.value += \'3\'"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="del" VALUE="Del" OnClick="Backspace(Calc.Input.value)"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="clear" VALUE="  c  " OnClick="Calc.Input.value = \'\'"></TD>
                  </TR>
                  <TR>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="four"  VALUE="  4  " OnClick="Calc.Input.value += \'4\'"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="five"  VALUE="  5  " OnCLick="Calc.Input.value += \'5\'"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="six"   VALUE="  6  " OnClick="Calc.Input.value += \'6\'"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="times" VALUE="  x  " OnClick="Calc.Input.value += \' * \'"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="div"   VALUE="  /  " OnClick="Calc.Input.value += \' / \'"></TD>
                  </TR>
                  <TR>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="seven" VALUE="  7  " OnClick="Calc.Input.value += \'7\'"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="eight" VALUE="  8  " OnCLick="Calc.Input.value += \'8\'"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="nine"  VALUE="  9  " OnClick="Calc.Input.value += \'9\'"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="plus"  VALUE="  +  " OnClick="Calc.Input.value += \' + \'"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="minus" VALUE="  -  " OnClick="Calc.Input.value += \' - \'"></TD>
                  </TR>
                  <TR>
                    <TD height="26" align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="decimalpoint"  VALUE="  .  " OnClick="Calc.Input.value += \'.\'"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="zero"  VALUE="  0  " OnClick="Calc.Input.value += \'0\'"></TD>
                    <TD align="center" bordercolor="#000000"></TD>
                    <TD align="center" bordercolor="#000000"></TD>
                    <TD align="center" bordercolor="#000000"><INPUT TYPE="button" NAME="DoIt"  VALUE="  =  " OnClick="Calc.Input.value = eval(Calc.Input.value)"></TD>
                  </TR>
                </TABLE>
              </td>
              <td align="left" valign="top" >
                <table width="90" cellspacing="0" cellpadding="3" BORDER="1" bgcolor="#000000">
                  <tr>
                    <TD colspan="3" bordercolor="#000000" align="left"><font color="#CCCCCC">Advanced Keypad:</font></TD>
                  </tr>
                  <tr>
                  <td bordercolor="#000000"><INPUT TYPE="button" NAME="sqrt"   VALUE=" &#8730; " OnClick="Calc.Input.value = Math.sqrt(Calc.Input.value)"></td>
                  <td bordercolor="#000000">&nbsp;</td>
                  <td bordercolor="#000000">&nbsp;</td>
                  </tr>
                  <tr>
                  <td bordercolor="#000000"><INPUT TYPE="button" NAME="sqr"   VALUE="X^2" OnClick="Calc.Input.value = (Calc.Input.value * Calc.Input.value)"></td>
                  <td bordercolor="#000000"><INPUT TYPE="button" NAME="cube"   VALUE="X^3" OnClick="Calc.Input.value = (Calc.Input.value * Calc.Input.value * Calc.Input.value)"></td>
                  <td bordercolor="#000000"><INPUT TYPE="button" NAME="tothepowerof"   VALUE="X^Y" OnClick=""></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="90" cellspacing="0" cellpadding="3" BORDER="1" bgcolor="#000000">
                  <tr>
                  <TD colspan="3" bordercolor="#000000" align="left"><font color="#CCCCCC">Constants:</font></TD>
                  </tr>
                  <tr>
                  <td bordercolor="#000000"><INPUT TYPE="image" NAME="pi" src="pi.PNG" Value="button" OnClick="Calc.Input.value += \'3.1415926535897932\'"></td>
                  <td bordercolor="#000000">&nbsp;</td>
                  <td bordercolor="#000000">&nbsp;</td>
                  <td bordercolor="#000000">&nbsp;</td>
                  <td bordercolor="#000000">&nbsp;</td>
                  <td bordercolor="#000000">&nbsp;</td>
                  <td bordercolor="#000000">&nbsp;</td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </TD>
      </TR>
      <TR>
        <TD bordercolor="#000000">&nbsp;</TD>
        <TD bordercolor="#000000">&nbsp;</TD>
      </TR>
      <TR>
        <TD bordercolor="#000000" colspan="2" align="center"><font color="#999999">This calculator was written by and is copyrighted by Craig Mayhew</font></TD>
      </TR>
    </TABLE>
    </FORM>
    </CENTER>

    <script language="javascript">
    function Backspace(answer)
      {
      Calc.Input.value = answer.substring(0, answer.length - 1);
      }
    </script>';
  }
}
