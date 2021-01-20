<?php
defined('BASEPATH') || exit('No direct script access allowed');

class GiddygoatSchema extends CI_Model
{
	public string $Class = "Class";
	public string $Class_booking = "Class_booking";
	public string $Fabric = "Fabric";
	public string $Fabric_type = "Fabric_type";
	public string $Member = "Member";
	public string $Notion_type = "Notion_type";
	public string $Notions = "Notions";
	public string $Purchase = "Purchase";
	public string $Purchase_details = "Purchase_details";
	public string $Shopping_cart = "Shopping_cart";
}
class ClassSchema extends CI_Model
{
	public string $class_id = "class_id";
	public string $name = "name";
	public string $description = "description";
	public string $dateOfClass = "dateOfClass";
	public string $timeOfClass = "timeOfClass";
	public string $price = "price";
	public string $maxAttendees = "maxAttendees";
}
class Class_bookingSchema extends CI_Model
{
	public string $class_id = "class_id";
	public string $member_id = "member_id";
	public string $paidInFull = "paidInFull";
	public string $balanceToBePaid = "balanceToBePaid";
}
class FabricSchema extends CI_Model
{
	public string $fabric_id = "fabric_id";
	public string $name = "name";
	public string $description = "description";
	public string $cost = "cost";
	public string $image = "image";
	public string $fabric_type_id = "fabric_type_id";
	public string $primaryColour = "primaryColour";
	public string $secondaryColour = "secondaryColour";
	public string $ternaryColour = "ternaryColour";
}
class Fabric_typeSchema extends CI_Model
{
	public string $fabric_type_id = "fabric_type_id";
	public string $fabricTypeName = "fabricTypeName";
	public string $description = "description";
}
class MemberSchema extends CI_Model
{
	public string $member_id = "member_id";
	public string $fName = "fName";
	public string $lName = "lName";
	public string $password = "password";
	public string $phone = "phone";
	public string $emailAddress = "emailAddress";
	public string $addressLine1 = "addressLine1";
	public string $addressLine2 = "addressLine2";
	public string $addressLine3 = "addressLine3";
	public string $city = "city";
	public string $county = "county";
	public string $country = "country";
	public string $subscribe = "subscribe";
}
class Notion_typeSchema extends CI_Model
{
	public string $notion_type_id = "notion_type_id";
	public string $notionTypeName = "notionTypeName";
	public string $description = "description";
}
class NotionsSchema extends CI_Model
{
	public string $notion_id = "notion_id";
	public string $name = "name";
	public string $description = "description";
	public string $cost = "cost";
	public string $image = "image";
	public string $notion_type_id = "notion_type_id";
}
class PurchaseSchema extends CI_Model
{
	public string $purchase_id = "purchase_id";
	public string $member_id = "member_id";
	public string $date_of_purchase = "date_of_purchase";
}
class Purchase_detailsSchema extends CI_Model
{
	public string $purchase_detail_id = "purchase_detail_id";
	public string $purchase_id = "purchase_id";
	public string $class_id = "class_id";
	public string $fabric_id = "fabric_id";
	public string $notion_id = "notion_id";
	public string $qty = "qty";
	public string $cost = "cost";
}
class Shopping_cartSchema extends CI_Model
{
	public string $id = "id";
	public string $session_id = "session_id";
	public string $class_id = "class_id";
	public string $fabric_id = "fabric_id";
	public string $notion_id = "notion_id";
	public string $product_name = "product_name";
	public string $product_desc = "product_desc";
	public string $quantity = "quantity";
	public string $price = "price";
	public string $date_added = "date_added";
	public string $image_path = "image_path";
}
