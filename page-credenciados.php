<?php get_header(); ?>
	<section class="fullwidth-background">
		<div class="breadcrumb-wrapper">
			<div class="container">
				<?php get_breadcrumbs();
				if(!empty($redux_options[$themePrefix.'ac_phrase_hair'])){
					echo '<h5 class="breadcrumb-title">'.get_the_title().'</h5>';
				} ?>
			</div>
		</div>
	</section>
	<div class="container">
		<div class="hr-invisible"></div>
			<section id="primary" class="content-full-width">
				<div class="container">
					<?php 
					if(have_posts()): while(have_posts()): the_post(); ?>
					<div class="blog-entry">
						<div class="entry-thumb">
                            <?php echo get_the_post_thumbnail(); ?>
                    	</div>
						<div class="entry-details">
							<div class="entry-title">
								<h3 class="border-title"><?php the_title(); ?></h3>
							</div>
							<article class="entry-metadata">
								<?php the_content(); ?>
							</article>
						</div>
						<?php endwhile; endif; ?>
					</div>

					<div class="blog-entry">
						<form class="contact-form" method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
							<div class="column dt-sc-one-half first animate" data-delay="100" data-animation="animated fadeIn">
								<p><input type="text" name="contactName" placeholder="Seu nome " required/> </p>
								<p><input type="email" name="contactEmail" placeholder="Email " required/></p>
							</div>
							<div class="column dt-sc-one-half animate" data-delay="300" data-animation="animated fadeIn">
								<p><input type="text" required maxlength="11" name="contactCell" placeholder="Celular "/></p>
								<p><input type="text" required name="contactCpfCnpj" placeholder="CPF ou CNPJ"/></p>
							</div>

							<ul class="phone">
								<li><i class="fa fa-mobile-phone"></i><?php echo $redux_options[$themePrefix.'cs_telephone']; ?></li>
								<li><i class="fa fa-envelope-o"></i><a href="mailto:<?php echo $redux_options[$themePrefix.'cs_email']; ?>"><?php echo $redux_options[$themePrefix.'cs_email']; ?></a></li>
							</ul>
							<div class="form-row aligncenter">
								<input type="submit" value="Enviar" name="submit">
							</div>
						</form>

						<?php 
						if( !empty( $_POST ) ){

							$adminMessage = "O usuário " . $_POST['contactName']." \r\n";
							$adminMessage .= "Email: ".$_POST['contactEmail']." \r\n";
							$adminMessage .= "Telefone: ".$_POST['contactCell'] ."\r\n";
							$adminMessage .= "CPF / CNPJ: ".$_POST['contactCpfCnpj']."\r\n";
							$adminMessage .= "Se tornou um credenciado(a)";							

							if( email_exists($_POST['contactEmail']) ){
								$user = get_user_by('email', $_POST['contactEmail']);

								// Change user role to accredited
								$user_id = wp_update_user( array(
									'ID'			=> $user->ID,
									'display_name'	=> $_POST['contactName'],
									'user_email'	=> $_POST['contactEmail'],
									'description'	=> "CPF / CNPJ: ".$_POST['contactCpfCnpj']."\r\nTelefone: ".$_POST['contactCell'],
									'role'			=> 'accredited'
									)
								);

								// Admin notification
								wp_mail( $redux_options[$themePrefix.'cs_email'], get_bloginfo('name').' - Novo usuário credenciado', $adminMessage );
							} else{
								// Inser a new user with accredited role
								wp_insert_user( array(
									'user_login' 	=> $_POST['contactEmail'],
									'user_pass'		=> get_bloginfo('name'),
									'display_name'	=> $_POST['contactName'],
									'user_email'	=> $_POST['contactEmail'],
									'description'	=> 'CPF / CNPJ: '.$_POST['contactCpfCnpj'],
									'role'			=> 'accredited'
									)
								);

								// Admin notification
								wp_mail( $redux_options[$themePrefix.'cs_email'], get_bloginfo('name').' - Novo usuário credenciado', $adminMessage );
							}
							
							// Coupon hash / name
							$hash = strtoupper( str_replace(' ', '', str_shuffle( get_bloginfo('name') . rand() ).'-VHS-'.str_shuffle( $_POST['contactName'] . rand() ) ) );

							// Checking if the user has been created 
							$coupons = get_posts( array(
								'post_type'			=> 'shop_coupon',
								'posts_per_page'	=> -1,
								'meta_key'			=> 'customer_email',
								'meta_value'		=> $_POST['contactEmail']
								)
							);
							if( !empty($coupons) ){
								// Get and format the expiry date of the coupon
								$expiryDate = date('d/m/Y', strtotime(get_post_meta($coupons[0]->ID, 'expiry_date', true)));
								// Message will be send to user at email
								$message = "Seu cupom de credenciado é: \r\n" . get_the_title($coupons[0]->ID) . "\r\n Com prazo de expiração em ".$expiryDate;
								wp_mail( $_POST['contactEmail'], get_bloginfo('name').' - Usuário credenciado', $message );
								echo '<script> alert("Você já faz parte de nossos credenciados. Seu cupom foi reenviado ao email de cadastro."); </script>';
							} else{
								// Inser a new special coupon by each user
								wp_insert_post( array(
									'post_excerpt'			=> 'Este cupom é destinado a '. $_POST['contactName'], 
									'post_title'			=> $hash,
									'post_status'			=> 'publish',
									'post_type'				=> 'shop_coupon',
									'meta_input'			=> array(
											'discount_type'		=> 'percent', 							// always discount will be by percent
											'coupon_amount'		=> 20, 									// Percent value of discount
											'minimum_amount'	=> 5000, 								// Discounts of this coupon will only be apply if total cart amount is bigger than 5000 reais
											'individual_use'	=> 'yes', 								// Customers can not use more than onde coupon
											'free_shipping'		=> 'no', 								// Just to reforce that there is no rule to shipping
											'customer_email'	=> $_POST['contactEmail'], 				// Each coupon is usefull just for the customer that sended this form
											'expiry_date'		=> date('Y-m-d', strtotime('+1 week'))	// Coupon will expiry after 7 days after creation
										)
									)
								);

								$userMessage = "Parabéns, agora você faz parte de nossa rede de credenciados.\r\n";
								$userMessage .= "Utilize o cupom de desconto abaixo: \r\n ".$hash;
								wp_mail( $_POST['contactEmail'], get_bloginfo('name').' - Novo usuário credenciado', $userMessage );
								echo '<script> alert("Obrigado. Para receber o cupom, verifique seu email."); </script>';
							}
						} ?>

					</div>
				</div>
			</section>
		</div>
	</diV>
<?php get_footer(); ?>