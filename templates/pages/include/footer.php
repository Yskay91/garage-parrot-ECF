<footer class="bd-footer" style="margin-top:8%;">
    <div class="container">
        <hr /><br>
        <div class="row mb-3 text-center">
            <div class="col-md-6 text-body-secondary">
                <h6>Contact</h6>
                <p>
                    Mail : garage-parrot@exemple.fr<br>
                    Téléphone : 04.50.10.10.10
                </p>

            </div>
            <div class="col-md-6 text-body-secondary">
                <h6>Horaires d'ouverture</h6>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col" class="bgTable"></th>
                            <th scope="col" class="bgTable">Matin</th>
                            <th scope="col" class="bgTable">Après-midi</th>
                        </tr>
                    </thead>
                    <!-- <tbody>
                        <?php foreach ($hours as $hour) { ?>
                            <tr>
                                <th scope="row"><?php echo $hour->dayWeek ?></th>
                                <td class="<?php echo !is_null($hour->morningOpenHours) && !is_null($hour->morningCloseHours) || !is_null($hour->afternoonOpenHours) && !is_null($hour->afternoonCloseHours) ? 'table-success' : 'table-danger' ?>">
                                    <?php echo !is_null($hour->morningOpenHours) ? date('H:i', strtotime($hour->morningOpenHours)) . " - " : ""; ?>
                                    <?php echo !is_null($hour->morningCloseHours) ? date('H:i', strtotime($hour->morningCloseHours)) : "Fermé"; ?>
                                </td>
                                <td class="<?php echo !is_null($hour->morningOpenHours) && !is_null($hour->morningCloseHours) && !is_null($hour->afternoonOpenHours) && !is_null($hour->afternoonCloseHours) ? 'table-success' : 'table-danger' ?>">
                                    <?php echo !is_null($hour->afternoonOpenHours) ? date('H:i', strtotime($hour->afternoonOpenHours)) . " - " : ""; ?>
                                    <?php echo !is_null($hour->afternoonCloseHours) ? date('H:i', strtotime($hour->afternoonCloseHours)) : "Fermé"; ?>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody> -->
                </table>
            </div>
        </div>
        &copy; 2023 Garage V. Parrot
    </div>
</footer>