<?php
	include_once 'Conexion.inc.php';
	include_once 'RepositorioEntrada.inc.php';
	include_once 'Entrada.inc.php';

	class EscritorEntradas {
		public static function escribirEntradas() {

			$entradas = RepositorioEntrada::obtener_todas_por_fecha_descendiente(Conexion::obtenerConexion());

			if (count($entradas)) {
				foreach ($entradas as $entrada) {
					self::escribirEntrada($entrada);
				}
			}
		}

		public static function escribirEntrada($entrada) {
			if (!isset($entrada)) {
				return;
			}
?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<?php
								echo $entrada->getId(). ': ' . $entrada->getTitulo();
							?>
						</div>

						<div class="panel-body">
							<p>
								<strong>
									<?php
										echo $entrada->getFecha();
									?>
								</strong>
							</p>

							<div class="text-justify">
								<?php
									// nl2br: new line to break rule
									echo nl2br(self::resumirTexto($entrada->getTexto()));
								?>
							</div>
							<br>
							<div class="text-left">
								<a href="<?php echo RUTA_ENTRADA . '/' . $entrada->getUrl() ?>" class="btn btn-primary" role="button">Seguir leyendo</a>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
		}

		public static function resumirTexto($texto) {
			$longitudMaxima = 400;

			$resultado = '';

			if (strlen($texto) >= $longitudMaxima) {

				$resultado = substr($texto, 0, $longitudMaxima) . '...';
			} else {
				$resultado = $texto;
			}

			return $resultado;
		}
	}
?>