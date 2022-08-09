<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Заказ')
            ->setEntityLabelInPlural('Заказы');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            FormField::addPanel('Клиент'),
            AssociationField::new('client', 'Заказчик'),
            TextField::new('clientName', 'Имя клиента'),
            TextField::new('clientEmail', 'email клиента'),
            FormField::addPanel('Исполнитель'),
            AssociationField::new('worker', 'Исполнитель'),
            AssociationField::new('service', 'Услуга')->onlyOnIndex(),
            FormField::addPanel('Время'),
            AssociationField::new('time', 'Дата выполнения заказа')->hideOnIndex(),
            DateTimeField::new('createdAt', 'Дата создания заказа')
        ];
    }
}
