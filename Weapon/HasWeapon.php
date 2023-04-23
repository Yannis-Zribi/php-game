<?php



trait HasWeapon
{

    public function takesWeapon(Weapon $weapon)
    {
        // echo "{$this} ramasse {$weapon->name} !".PHP_EOL;
        $this->weapon = $weapon;
    }

    public function dropsWeapon()
    {
        if ($this->hasWeapon()) {
            // echo "{$this} fait tomber {$this->weapon->name}…".PHP_EOL;
            $this->weapon = null;
        }
    }

    public function hasWeapon()
    {
        return $this->weapon instanceof Weapon;
    }
}