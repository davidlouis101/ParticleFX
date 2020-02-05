<?php

namespace ParticleFx;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;

use pocketmine\Player;

use pocketmine\utils\Config;

use pocketmine\level\particle\DustParticle;

use pocketmine\plugin\Plugin;

use pocketmine\Server;

use pocketmine\scheduler\Task as PluginTask;

use pocketmine\utils\TextFormat;

use pocketmine\math\Vector3;

use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener{

		public $players = [];

    public $particle1 = array("RedCircleParticles");

    public $particle2 = array("BlueCircleParticles");

    public $particle3 = array("GreenCircleParticles");

    public $particle4 = array("WhiteCircleParticles");

    public $particle5 = array("YellowCircleParticles");

    public $name = array();

	

	public function onEnable()

	{

		$this->getLogger()->info("[Enable] sub to DeadOnBushPH");

        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->getScheduler()->scheduleRepeatingTask(new Particle($this), 5);

	}

	

    public function checkDepends(){

        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");

        if(is_null($this->formapi)){

            $this->getLogger()->info("[Disable] Pls Add FormAPI Plugin!");

            $this->getPluginLoader()->disablePlugin($this);

        }

    }

	

	public function onCommand(CommandSender $player, Command $command, string $label, array $params) : bool

	{

	$name = $player->getName();

	$level = $player->getLevel();

		if(!$player instanceof Player){

			$player->sendMessage("Use the command ingame");

			return false;

		}

		$username = strtolower($player->getName());

        if($command->getName() == "pfxui"){

            if(!($player instanceof Player)){

                    $player->sendMessage("§7This command can't be used here. Sorry!");

                    return true;

            }

            $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");

            $form = $api->createSimpleForm(function (Player $player, $data){

                $result = $data;

                if ($result == null) {

                }

                switch ($result) {

                        case 0:

                            break;

                        case 1:

                        $command = "pfxred";

								    $this->getServer()->getCommandMap()->dispatch($player, $command);

						    break;

					    case 2:

                        $command = "pfxblue";

								    $this->getServer()->getCommandMap()->dispatch($player, $command);

						    break;

					    case 3:

                        $command = "pfxgreen";

								    $this->getServer()->getCommandMap()->dispatch($player, $command);

						    break;

					    case 4:

                        $command = "pfxwhite";

								    $this->getServer()->getCommandMap()->dispatch($player, $command);

						    break;

					    case 5:

                        $command = "pfxyellow";

								    $this->getServer()->getCommandMap()->dispatch($player, $command);

						    break;

                }

            });

            $form->setTitle("§lParticleUI");

            $form->setContent("§l§8» §r§eEnable Or Disable Particles\n§l§8» §r§eParticleFx by. DeadOnBushPH");

            $form->addButton("§4Exit");

            $form->addButton("§0Red Particles");

            $form->addButton("§0Blue Particles");

            $form->addButton("§0Green Particles");

            $form->addButton("§0White Particles");

            $form->addButton("§0Yellow Particles");

            $form->sendToPlayer($player);

        }

		if($command->getName() == "pfxred"){

			if(!in_array($name, $this->particle1)) {

				

			    $this->particle1[] = $name;

			    $player->sendMessage("§l§7[ §eParticleFx §7] §r§fParticleRedFx has been enabled");

			

		    } else {

			    

			    unset($this->particle1[array_search($name, $this->particle1)]);

				$player->sendMessage("§l§7[ §eParticleFx §7] §r§fParticleRedFx has been disabled");

			}

		}

		if($command->getName() == "pfxblue"){

			if(!in_array($name, $this->particle2)) {

				

			    $this->particle2[] = $name;

			    $player->sendMessage("§l§7[ §eParticleFx §7] §r§fParticleBlueFx has been enabled");

			

		    } else {

			    

			    unset($this->particle2[array_search($name, $this->particle2)]);

				$player->sendMessage("§l§7[ §eParticleFx §7] §r§fParticleBlueFx has been disabled");

			}

		}

		if($command->getName() == "pfxgreen"){

			if(!in_array($name, $this->particle3)) {

				

			    $this->particle3[] = $name;

			    $player->sendMessage("§l§7[ §eParticleFx §7] §r§fParticleGreenFx has been enabled");

			

		    } else {

			    

			    unset($this->particle3[array_search($name, $this->particle3)]);

				$player->sendMessage("§l§7[ §eParticleFx §7] §r§fParticleGreenFx has been disabled");

			}

		}

		if($command->getName() == "pfxwhite"){

			if(!in_array($name, $this->particle4)) {

				

			    $this->particle4[] = $name;

			    $player->sendMessage("§l§7[ §eParticleFx §7] §r§fParticleWhiteFx has been enabled");

			

		    } else {

			    

			    unset($this->particle4[array_search($name, $this->particle4)]);

				$player->sendMessage("§l§7[ §eParticleFx §7] §r§fParticleWhiteFx has been disabled");

			}

		}

		if($command->getName() == "pfxyellow"){

			if(!in_array($name, $this->particle5)) {

				

			    $this->particle5[] = $name;

			    $player->sendMessage("§l§7[ §eParticleFx §7] §r§fParticleYellowFx has been enabled");

			

		    } else {

			    

			    unset($this->particle5[array_search($name, $this->particle5)]);

				$player->sendMessage("§l§7[ §eParticleFx §7] §r§fParticleYellowFx has been disabled");

			}

		}

		return true;

	}

}

class Particle extends PluginTask {

	

	public function __construct($plugin) {

		$this->plugin = $plugin;

	}

	public function onRun($tick) {

		

		foreach($this->plugin->getServer()->getOnlinePlayers() as $player) {

			$name = $player->getName();

			$inv = $player->getInventory();

			

			$players = $player->getLevel()->getPlayers();

			$level = $player->getLevel();

			

			$x = $player->getX();

			$y = $player->getY() + 2;

			$z = $player->getZ();

			

			if(in_array($name, $this->plugin->particle1)) {

				

				$r = 255;

				$g = 0;

				$b = 0;

				

				$center = new Vector3($x, $y, $z);

				$particle = new DustParticle($center, $r, $g, $b, 1);

				

				for($yaw = 0; $yaw <= 10; $yaw += (M_PI * 2) / 20){

					$x = -sin($yaw) + $center->x;

					$z = cos($yaw) + $center->z;

					$y = $center->y;

					

					$particle->setComponents($x, $y, $z);

					$level->addParticle($particle);

						

				}

		    }

			if(in_array($name, $this->plugin->particle2)) {

				

				$r = 0;

				$g = 0;

				$b = 255;

				

				$center = new Vector3($x, $y, $z);

				$particle = new DustParticle($center, $r, $g, $b, 1);

				

				for($yaw = 0; $yaw <= 10; $yaw += (M_PI * 2) / 20){

					$x = -sin($yaw) + $center->x;

					$z = cos($yaw) + $center->z;

					$y = $center->y;

					

					$particle->setComponents($x, $y, $z);

					$level->addParticle($particle);

						

				}

			

		    }

		    

			if(in_array($name, $this->plugin->particle3)) {

				

				$r = 0;

				$g = 255;

				$b = 0;

				

				$center = new Vector3($x, $y, $z);

				$particle = new DustParticle($center, $r, $g, $b, 1);

				

				for($yaw = 0; $yaw <= 10; $yaw += (M_PI * 2) / 20){

					$x = -sin($yaw) + $center->x;

					$z = cos($yaw) + $center->z;

					$y = $center->y;

					

					$particle->setComponents($x, $y, $z);

					$level->addParticle($particle);

						

				}

		    }

		    

			if(in_array($name, $this->plugin->particle4)) {

				

				$r = 255;

				$g = 255;

				$b = 255;

				

				$center = new Vector3($x, $y, $z);

				$particle = new DustParticle($center, $r, $g, $b, 1);

				

				for($yaw = 0; $yaw <= 10; $yaw += (M_PI * 2) / 20){

					$x = -sin($yaw) + $center->x;

					$z = cos($yaw) + $center->z;

					$y = $center->y;

					

					$particle->setComponents($x, $y, $z);

					$level->addParticle($particle);

						

				}

		    }

		    

			if(in_array($name, $this->plugin->particle5)) {

				

				$r = 255;

				$g = 255;

				$b = 0;

				

				$center = new Vector3($x, $y, $z);

				$particle = new DustParticle($center, $r, $g, $b, 1);

				

				for($yaw = 0; $yaw <= 10; $yaw += (M_PI * 2) / 20){

					$x = -sin($yaw) + $center->x;

					$z = cos($yaw) + $center->z;

					$y = $center->y;

					

					$particle->setComponents($x, $y, $z);

					$level->addParticle($particle);

						

				}

		    }

		

	    }

	

    }

    

}x, $y, $z);

					$level->addParticle($particle);

						

				}

		    }

		    

			if(in_array($name, $this->plugin->particle4)) {

				

				$r = 255;

				$g = 255;

				$b = 255;

				

				$center = new Vector3($x, $y, $z);

				$particle = new DustParticle($center, $r, $g, $b, 1);

				

				for($yaw = 0; $yaw <= 10; $yaw += (M_PI * 2) / 20){

					$x = -sin($yaw) + $center->x;

					$z = cos($yaw) + $center->z;

					$y = $center->y;

					

					$particle->setComponents($x, $y, $z);

					$level->addParticle($particle);

						

				}

		    }

		    

			if(in_array($name, $this->plugin->particle5)) {

				

				$r = 255;

				$g = 255;

				$b = 0;

		
