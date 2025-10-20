<?php
require_once 'UserBuilder.php';

class UserDirector {
    public function buildUser(UserBuilder $builder, array $data): User {
        $builder->reset();
        $builder->setData($data);
        return $builder->getUser();
    }
}
