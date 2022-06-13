<?php


/**
 * ********  Виртуальные машины   ***********
*/

/**
 * Vargant
 *
 * Vargant.configure
 * Увеличение оперативной памяти

Vagrant.configure(2) do |config|
    config.vm.box = "ubuntu/trusty64"
    config.vm.provider "virtualbox" do |vb|
        vb.memory = "2048"
    end
end
*/