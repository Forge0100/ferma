									</div>
								</div>
								<div class="we_links">
																
								</div>
							</div>
						</div>
					</div>

				</div>

					<?php
						$ip = $_SERVER['REMOTE_ADDR'];
						$dd = time() - 180;
						$date = time();
						$db->query("DELETE FROM tb_online WHERE date < ?s", $dd);
						if(isset($_SESSION['login'])) {
							$login = $_SESSION['login'];
							$uo_result = $db->query("SELECT * FROM tb_online WHERE login = ?s", $login);
							if($db->numRows($uo_result) == 0) {
								$data = array('ip' => $ip, 'login' => $login, 'date' => $date, 'page' => $page);
								$db->query("INSERT INTO tb_online SET ?u", $data);
							} elseif($db->numRows($uo_result) == 1) {
								$q = $db->fetch($uo_result);
								$data = array('login' => $q['login'], 'date' => $date, 'page' => $page);
								$db->query("UPDATE tb_online SET ?u WHERE login = ?s", $data, $data['login']);
							}else{
								$db->query("DELETE FROM tb_online WHERE login = ?s", $login);
								$data = array('ip' => $ip, 'login' => $login, 'date' => $date, 'page' => $page);
								$db->query("INSERT INTO tb_online SET ?u", $data);
							}
						}else{
							$login = 'Гость';

							$uo_result = $db->query("SELECT * FROM tb_online WHERE ip = '$ip' OR login = '$login'");
							if($db->numRows($uo_result) == 0) {
								$data = array('ip' => $ip, 'login' => $login, 'date' => $date, 'page' => $page);
								$db->query("INSERT INTO tb_online SET ?u", $data);
							} else {
								$q = $db->fetch($uo_result);
								$data = array('login' => $login, 'date' => $date, 'page' => $page);
								$db->query("UPDATE tb_online SET ?u WHERE login = ?s", $data, $ip);
							}
						}
					?>
				</div>
			</div>
			<div class="footer-box">
				<div class="footer">
				
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
