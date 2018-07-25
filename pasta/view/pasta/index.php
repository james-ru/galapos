<body>
    <table>
      <form class="" action="index.php" method="post">
        <tr>
            <th>Aankoop</th>
            <th class="person">Persoon</th>
            <th class="price">Prijs</th>
            <th class="price">Subtotaal</th>
        </tr>
        <tr>
            <input type="hidden" name="action" value="insertAankoop" />
            <td><input type="text" id="aankoop" name="aankoop" value="<?php
                  if (!empty($_POST['aankoop'])) {echo $_POST['aankoop'];}
                  ?>">
                  <?php
                  if (!empty($errors['aankoop'])) {
                    echo '<span class="error">' . $errors['aankoop'] . '</span>';
                  }
                  ?>
            </td>
            <td>
                <select class="persoon-select" id="persoon" name="persoon">
                    <option value="Nastya">Nastya</option>
                    <option value="James">James</option>
                </select>
            </td>
            <td><input type="number" step="0.01" id="prijs" name="prijs" value="<?php
                  if (!empty($_POST['prijs'])) {echo $_POST['prijs'];}?>">
              <?php if (!empty($errors['prijs'])) {echo '<span class="error">' . $errors['prijs'] . '</span>';}?>
            </td>
            <td>
              <input class="add" type="submit" name="" value="Invoegen">
            </td>
        </tr>
        <?php  $total = 0;?>
        <?php foreach(array_reverse($aankopen) as $aankoop): ?>
          <?php
          $aankoopTotal = $aankoop['prijs'];
          $total += $aankoopTotal;
          ?>
        <div class="aankopen">
        <tr>
            <td><?php echo $aankoop['aankoop'] ?></td>
            <td><?php echo $aankoop['persoon'] ?></td>
            <td>&euro; <?php echo $aankoop['prijs'] ?></td>
            <td>&euro; <?php echo $total;?></td>
        </tr>
        </div>
      <?php endforeach; ?>
      </form>
    </table>

    <br>
    Nastya: &euro; <?php foreach($totaalNastya as $totaal): echo round($totaal, 2); endforeach; ?>

    <br>
    James: &euro; <?php foreach($totaalJames as $totaal): echo round($totaal, 2); endforeach; ?>
</body>
