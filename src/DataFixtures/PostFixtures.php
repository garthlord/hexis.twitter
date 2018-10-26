<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $ivan = $manager->getRepository(User::class)->findOneBy(['email' => 'ivan@hexis.com']);
        $sinisa = $manager->getRepository(User::class)->findOneBy(['email' => 'sinisa@hexis.com']);
        $goran = $manager->getRepository(User::class)->findOneBy(['email' => 'goranceko11@gmail.com']);
        
        $data = [
            ['user' => $ivan, 'post' => 'Ut egestas odio vitae ipsum dapibus, eu finibus enim sodales. Aliquam nec cursus elit. Aliquam suscipit augue sit amet nullam.',],
            ['user' => $sinisa, 'post' => 'Sed sagittis risus dui, nec facilisis lectus pharetra volutpat. Suspendisse lobortis dapibus laoreet. Aliquam ut interdum sed.',],
            ['user' => $ivan, 'post' => 'Sed vitae interdum tellus. Duis eget metus quis nisi ullamcorper commodo. Curabitur porta quam a lacus pharetra, eget posuere.',],
            ['user' => $goran, 'post' => 'Aenean sit amet pharetra ex. In sit amet ullamcorper tortor. Suspendisse vel massa a nisi vehicula porttitor. Praesent nullam.',],
            ['user' => $sinisa, 'post' => 'Nunc id accumsan eros. Pellentesque turpis massa, bibendum ac sapien et, elementum volutpat nisi. Duis scelerisque ipsum amet.',],
            ['user' => $ivan, 'post' => 'Ut egestas odio vitae ipsum dapibus, eu finibus enim sodales. Aliquam nec cursus elit. Aliquam suscipit augue sit amet nullam.',],
            ['user' => $sinisa, 'post' => 'Sed sagittis risus dui, nec facilisis lectus pharetra volutpat. Suspendisse lobortis dapibus laoreet. Aliquam ut interdum sed.',],
            ['user' => $ivan, 'post' => 'Sed vitae interdum tellus. Duis eget metus quis nisi ullamcorper commodo. Curabitur porta quam a lacus pharetra, eget posuere.',],
            ['user' => $goran, 'post' => 'Aenean sit amet pharetra ex. In sit amet ullamcorper tortor. Suspendisse vel massa a nisi vehicula porttitor. Praesent nullam.',],
            ['user' => $sinisa, 'post' => 'Nunc id accumsan eros. Pellentesque turpis massa, bibendum ac sapien et, elementum volutpat nisi. Duis scelerisque ipsum amet.',],
            ['user' => $ivan, 'post' => 'Ut egestas odio vitae ipsum dapibus, eu finibus enim sodales. Aliquam nec cursus elit. Aliquam suscipit augue sit amet nullam.',],
            ['user' => $sinisa, 'post' => 'Sed sagittis risus dui, nec facilisis lectus pharetra volutpat. Suspendisse lobortis dapibus laoreet. Aliquam ut interdum sed.',],
            ['user' => $ivan, 'post' => 'Sed vitae interdum tellus. Duis eget metus quis nisi ullamcorper commodo. Curabitur porta quam a lacus pharetra, eget posuere.',],
            ['user' => $goran, 'post' => 'Aenean sit amet pharetra ex. In sit amet ullamcorper tortor. Suspendisse vel massa a nisi vehicula porttitor. Praesent nullam.',],
            ['user' => $sinisa, 'post' => 'Nunc id accumsan eros. Pellentesque turpis massa, bibendum ac sapien et, elementum volutpat nisi. Duis scelerisque ipsum amet.',],
            ['user' => $ivan, 'post' => 'Ut egestas odio vitae ipsum dapibus, eu finibus enim sodales. Aliquam nec cursus elit. Aliquam suscipit augue sit amet nullam.',],
            ['user' => $sinisa, 'post' => 'Sed sagittis risus dui, nec facilisis lectus pharetra volutpat. Suspendisse lobortis dapibus laoreet. Aliquam ut interdum sed.',],
            ['user' => $ivan, 'post' => 'Sed vitae interdum tellus. Duis eget metus quis nisi ullamcorper commodo. Curabitur porta quam a lacus pharetra, eget posuere.',],
            ['user' => $goran, 'post' => 'Aenean sit amet pharetra ex. In sit amet ullamcorper tortor. Suspendisse vel massa a nisi vehicula porttitor. Praesent nullam.',],
            ['user' => $sinisa, 'post' => 'Nunc id accumsan eros. Pellentesque turpis massa, bibendum ac sapien et, elementum volutpat nisi. Duis scelerisque ipsum amet.',],
            ['user' => $ivan, 'post' => 'Ut egestas odio vitae ipsum dapibus, eu finibus enim sodales. Aliquam nec cursus elit. Aliquam suscipit augue sit amet nullam.',],
            ['user' => $sinisa, 'post' => 'Sed sagittis risus dui, nec facilisis lectus pharetra volutpat. Suspendisse lobortis dapibus laoreet. Aliquam ut interdum sed.',],
            ['user' => $ivan, 'post' => 'Sed vitae interdum tellus. Duis eget metus quis nisi ullamcorper commodo. Curabitur porta quam a lacus pharetra, eget posuere.',],
            ['user' => $goran, 'post' => 'Aenean sit amet pharetra ex. In sit amet ullamcorper tortor. Suspendisse vel massa a nisi vehicula porttitor. Praesent nullam.',],
            ['user' => $sinisa, 'post' => 'Nunc id accumsan eros. Pellentesque turpis massa, bibendum ac sapien et, elementum volutpat nisi. Duis scelerisque ipsum amet.',],
        ];
        
        foreach($data as $i)
        {
            $post = new Post();
            $post->setPost($i['post']);
            $post->setUser($i['user']);
            $manager->persist($post);
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
