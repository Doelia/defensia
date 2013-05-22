<?php

/**
*	$adj nombre de page d'écart entre les ...
*	$url dlf "<?php echo URL ?>games&page=
*
*/
function pagination($current, $total, $adj, $url)
{
	if ($total > 1)
	{
		if ($current > 1) {
			?><a href="<?php echo $url.($current-1) ?>">Précedent</a><?php
		} else {
			?><?php
		}

		if ($total < 7 + ($adj * 2)) {
			for ($i=1; $i<=$total; $i++) {
				if ($current == $i) { ?>
					<span class="active"><?php echo $i ?></span>
				<?php } else { ?>
					<a href="<?php echo $url.$i ?>"><?php echo $i ?></a>
				<?php }
			}
		}
		else
		{
			if ($current < 2 + ($adj * 2)) {

				for ($i = 1; $i < 4 + ($adj * 2); $i++)
				{
				   if ($current == $i) { ?>
						<span class="active"><?php echo $i ?></span>
					<?php } else { ?>
						<a href="<?php echo $url.$i ?>"><?php echo $i ?></a>
					<?php }
				}

				echo "...";

				?>
				<a href="<?php echo $url.($total-1) ?>"><?php echo $total-1 ?></a>
				<a href="<?php echo $url.$total ?>"><?php echo $total ?></a>
				<?php
			}
			elseif ( (($adj * 2) + 1 < $current) && ($current < $total - ($adj * 2)) ) {


				?>
				<a href="<?php echo $url ?>">1</a>
				<a href="<?php echo $url ?>&page=2">2</a>
				<?php

				echo "...";

				for ($i = $current - $adj; $i <= $current + $adj; $i++) {
					if ($current == $i) { ?>
						<span class="active"><?php echo $i ?></span>
					<?php } else { ?>
						<a href="<?php echo $url.$i ?>"><?php echo $i ?></a>
					<?php }
				}

			   echo "...";

				?>
				<a href="<?php echo $url.($total-1) ?>"><?php echo $total-1 ?></a>
				<a href="<?php echo $url.$total ?>"><?php echo $total ?></a>
				<?php
			}

			else {
				?>
				<a href="<?php echo $url ?>">1</a>
				<a href="<?php echo $url ?>&page=2">2</a>
				<?php

				echo "...";

				for ($i = $total - (2 + ($adj * 2)); $i <= $total; $i++) {
					if ($current == $i) { ?>
						<span class="active"><?php echo $i ?></span>
					<?php } else { ?>
						<a href="<?php echo $url.$i ?>"><?php echo $i ?></a>
					<?php }
				}
			}
		}

		if ($current != $total) {
			?><a href="<?php echo URL ?>games&page=<?php echo $current+1 ?>">Suivante</a><?php
		} else {
			?><?php
		}
	} // Au moins 2 pages
}