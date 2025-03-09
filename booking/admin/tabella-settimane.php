<div class="table-responsive table-card mb-1">
    <table class="table table-bordered table-nowrap">
        <tbody>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 17</th>
                <td><span class="id-lettino">225</span> <br>
                    <?php
                    // if (isset($lettiniPrenotati[225])) {
                    //     echo "<b>Prenotazione: </b>" . $lettiniPrenotati[225]['codice_prenotazione'] . "<br>";
                    //     echo "<b>Cliente: </b>" . $lettiniPrenotati[225]['nome_cliente'] . " (" . $lettiniPrenotati[225]['lingua'] . ") <br>";
                    //     echo $lettiniPrenotati[225]['email'] . " / " . $lettiniPrenotati[225]['telefono'] . "<br>";
                    // }
                    if (isset($lettiniPrenotati[225])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[225]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[225]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[225]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[225]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[225]['email']) . " / " . htmlspecialchars($lettiniPrenotati[225]['telefono']) . "<br>";
                    }

                    ?>
                </td>
                <td><span class="id-lettino">226</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[226])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[225]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[226]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[226]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[226]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[226]['email']) . " / " . htmlspecialchars($lettiniPrenotati[226]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">227</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[227])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[227]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[227]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[227]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[227]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[227]['email']) . " / " . htmlspecialchars($lettiniPrenotati[227]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">228</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[228])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[228]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[228]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[228]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[228]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[228]['email']) . " / " . htmlspecialchars($lettiniPrenotati[228]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 16</th>
                <td><span class="id-lettino">211</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[211])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[211]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[211]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[211]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[211]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[211]['email']) . " / " . htmlspecialchars($lettiniPrenotati[211]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">212</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[212])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[212]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[212]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[212]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[212]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[212]['email']) . " / " . htmlspecialchars($lettiniPrenotati[212]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">213</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[213])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[213]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[213]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[213]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[213]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[213]['email']) . " / " . htmlspecialchars($lettiniPrenotati[213]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">214</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[214])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[214]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[214]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[214]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[214]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[214]['email']) . " / " . htmlspecialchars($lettiniPrenotati[214]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 15</th>
                <td><span class="id-lettino">197</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[197])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[197]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[197]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[197]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[197]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[197]['email']) . " / " . htmlspecialchars($lettiniPrenotati[197]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">198</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[198])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[198]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[198]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[198]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[198]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[198]['email']) . " / " . htmlspecialchars($lettiniPrenotati[198]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">199</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[199])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[199]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[199]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[199]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[199]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[199]['email']) . " / " . htmlspecialchars($lettiniPrenotati[199]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">200</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[200])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[200]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[200]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[200]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[200]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[200]['email']) . " / " . htmlspecialchars($lettiniPrenotati[200]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 14</th>
                <td><span class="id-lettino">183</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[183])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[183]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[183]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[183]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[183]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[183]['email']) . " / " . htmlspecialchars($lettiniPrenotati[183]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">184</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[184])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[184]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[184]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[184]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[184]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[184]['email']) . " / " . htmlspecialchars($lettiniPrenotati[184]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">185</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[185])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[185]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[185]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[185]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[185]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[185]['email']) . " / " . htmlspecialchars($lettiniPrenotati[185]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">186</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[186])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[186]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[186]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[186]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[186]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[186]['email']) . " / " . htmlspecialchars($lettiniPrenotati[186]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 13</th>
                <td><span class="id-lettino">169</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[169])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[169]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[169]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[169]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[169]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[169]['email']) . " / " . htmlspecialchars($lettiniPrenotati[169]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">170</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[170])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[170]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[170]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[170]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[170]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[170]['email']) . " / " . htmlspecialchars($lettiniPrenotati[170]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">171</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[171])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[171]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[171]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[171]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[171]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[171]['email']) . " / " . htmlspecialchars($lettiniPrenotati[171]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">172</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[172])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[172]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[172]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[172]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[172]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[172]['email']) . " / " . htmlspecialchars($lettiniPrenotati[172]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 12</th>
                <td><span class="id-lettino">155</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[155])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[155]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[155]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[155]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[155]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[155]['email']) . " / " . htmlspecialchars($lettiniPrenotati[155]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">156</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[156])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[156]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[156]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[156]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[156]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[156]['email']) . " / " . htmlspecialchars($lettiniPrenotati[156]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">157</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[157])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[157]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[157]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[157]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[157]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[157]['email']) . " / " . htmlspecialchars($lettiniPrenotati[157]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">158</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[158])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[158]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[158]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[158]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[158]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[158]['email']) . " / " . htmlspecialchars($lettiniPrenotati[158]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 11</th>
                <td><span class="id-lettino">141</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[141])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[141]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[141]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[141]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[141]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[141]['email']) . " / " . htmlspecialchars($lettiniPrenotati[141]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">142</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[142])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[142]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[142]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[142]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[142]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[142]['email']) . " / " . htmlspecialchars($lettiniPrenotati[142]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">143</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[143])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[143]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[143]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[143]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[143]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[143]['email']) . " / " . htmlspecialchars($lettiniPrenotati[143]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">144</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[144])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[144]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[144]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[144]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[144]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[144]['email']) . " / " . htmlspecialchars($lettiniPrenotati[144]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 10</th>
                <td><span class="id-lettino">127</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[127])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[127]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[127]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[127]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[127]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[127]['email']) . " / " . htmlspecialchars($lettiniPrenotati[127]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">128</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[128])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[128]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[128]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[128]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[128]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[128]['email']) . " / " . htmlspecialchars($lettiniPrenotati[128]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">129</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[129])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[129]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[129]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[129]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[129]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[129]['email']) . " / " . htmlspecialchars($lettiniPrenotati[129]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">130</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[130])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[130]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[130]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[130]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[130]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[130]['email']) . " / " . htmlspecialchars($lettiniPrenotati[130]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 9</th>
                <td><span class="id-lettino">113</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[113])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[113]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[113]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[113]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[113]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[113]['email']) . " / " . htmlspecialchars($lettiniPrenotati[113]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">114</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[114])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[114]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[114]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[114]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[114]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[114]['email']) . " / " . htmlspecialchars($lettiniPrenotati[114]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">115</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[115])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[115]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[115]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[115]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[115]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[115]['email']) . " / " . htmlspecialchars($lettiniPrenotati[115]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">116</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[116])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[116]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[116]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[116]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[116]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[116]['email']) . " / " . htmlspecialchars($lettiniPrenotati[116]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 8</th>
                <td><span class="id-lettino">99</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[99])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[99]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[99]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[99]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[99]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[99]['email']) . " / " . htmlspecialchars($lettiniPrenotati[99]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">100</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[100])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[100]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[100]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[100]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[100]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[100]['email']) . " / " . htmlspecialchars($lettiniPrenotati[100]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">101</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[101])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[101]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[101]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[101]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[101]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[101]['email']) . " / " . htmlspecialchars($lettiniPrenotati[101]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">102</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[102])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[102]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[102]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[102]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[102]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[102]['email']) . " / " . htmlspecialchars($lettiniPrenotati[102]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 7</th>
                <td><span class="id-lettino">85</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[85])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[85]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[85]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[85]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[85]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[85]['email']) . " / " . htmlspecialchars($lettiniPrenotati[85]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">86</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[86])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[86]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[86]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[86]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[86]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[86]['email']) . " / " . htmlspecialchars($lettiniPrenotati[86]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">87</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[87])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[87]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[87]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[87]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[87]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[87]['email']) . " / " . htmlspecialchars($lettiniPrenotati[87]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">88</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[88])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[88]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[88]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[88]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[88]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[88]['email']) . " / " . htmlspecialchars($lettiniPrenotati[88]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 6</th>
                <td><span class="id-lettino">71</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[71])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[71]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[71]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[71]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[71]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[71]['email']) . " / " . htmlspecialchars($lettiniPrenotati[71]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">72</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[72])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[72]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[72]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[72]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[72]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[72]['email']) . " / " . htmlspecialchars($lettiniPrenotati[72]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">73</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[73])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[73]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[73]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[73]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[73]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[73]['email']) . " / " . htmlspecialchars($lettiniPrenotati[73]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">74</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[74])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[74]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[74]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[74]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[74]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[74]['email']) . " / " . htmlspecialchars($lettiniPrenotati[74]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 5</th>
                <td><span class="id-lettino">57</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[57])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[57]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[57]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[57]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[57]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[57]['email']) . " / " . htmlspecialchars($lettiniPrenotati[57]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">58</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[58])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[58]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[58]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[58]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[58]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[58]['email']) . " / " . htmlspecialchars($lettiniPrenotati[58]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">59</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[59])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[59]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[59]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[59]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[59]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[59]['email']) . " / " . htmlspecialchars($lettiniPrenotati[59]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">60</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[60])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[60]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[60]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[60]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[60]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[60]['email']) . " / " . htmlspecialchars($lettiniPrenotati[60]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 4</th>
                <td><span class="id-lettino">43</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[43])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[43]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[43]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[43]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[43]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[43]['email']) . " / " . htmlspecialchars($lettiniPrenotati[43]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">44</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[44])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[44]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[44]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[44]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[44]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[44]['email']) . " / " . htmlspecialchars($lettiniPrenotati[44]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">45</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[45])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[45]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[45]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[45]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[45]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[45]['email']) . " / " . htmlspecialchars($lettiniPrenotati[45]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">46</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[46])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[46]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[46]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[46]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[46]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[46]['email']) . " / " . htmlspecialchars($lettiniPrenotati[46]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 3</th>
                <td><span class="id-lettino">29</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[29])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[29]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[29]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[29]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[29]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[29]['email']) . " / " . htmlspecialchars($lettiniPrenotati[29]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">30</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[30])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[30]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[30]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[30]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[30]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[30]['email']) . " / " . htmlspecialchars($lettiniPrenotati[30]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">31</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[31])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[31]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[31]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[31]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[31]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[31]['email']) . " / " . htmlspecialchars($lettiniPrenotati[31]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">32</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[32])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[32]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[32]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[32]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[32]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[32]['email']) . " / " . htmlspecialchars($lettiniPrenotati[32]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 2</th>
                <td><span class="id-lettino">15</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[15])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[15]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[15]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[15]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[15]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[15]['email']) . " / " . htmlspecialchars($lettiniPrenotati[15]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">16</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[16])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[16]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[16]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[16]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[16]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[16]['email']) . " / " . htmlspecialchars($lettiniPrenotati[16]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">17</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[17])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[17]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[17]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[17]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[17]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[17]['email']) . " / " . htmlspecialchars($lettiniPrenotati[17]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">18</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[18])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[18]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[18]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[18]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[18]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[18]['email']) . " / " . htmlspecialchars($lettiniPrenotati[18]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 5%; background-color: #fafafa;">FILA 1</th>
                <td><span class="id-lettino">1</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[1])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[1]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[1]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[1]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[1]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[1]['email']) . " / " . htmlspecialchars($lettiniPrenotati[1]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">2</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[2])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[2]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[2]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[2]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[2]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[2]['email']) . " / " . htmlspecialchars($lettiniPrenotati[2]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">3</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[3])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[3]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[3]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[3]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[3]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[3]['email']) . " / " . htmlspecialchars($lettiniPrenotati[3]['telefono']) . "<br>";
                    }
                    ?>
                </td>
                <td><span class="id-lettino">4</span> <br>
                    <?php
                    if (isset($lettiniPrenotati[4])) {
                        echo "<b>Prenotazione: </b>";
                        echo '<form action="dettaglio-prenotazione.php" method="POST" style="display:inline;">
                                <input type="hidden" name="codice_prenotazione" value="' . htmlspecialchars($lettiniPrenotati[4]['codice_prenotazione']) . '">
                                <button type="submit" class="fw-medium link-primary border-0 bg-transparent p-0" style="text-decoration: none;">
                                    #' . htmlspecialchars($lettiniPrenotati[4]['codice_prenotazione']) . '
                                </button>
                              </form>';
                        echo "<br>";
                        echo "<b>Cliente: </b>" . htmlspecialchars($lettiniPrenotati[4]['nome_cliente']) . " (" . htmlspecialchars($lettiniPrenotati[4]['lingua']) . ") <br>";
                        echo htmlspecialchars($lettiniPrenotati[4]['email']) . " / " . htmlspecialchars($lettiniPrenotati[4]['telefono']) . "<br>";
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>