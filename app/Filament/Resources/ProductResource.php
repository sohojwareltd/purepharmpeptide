<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ResourcePermissionTrait;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    use ResourcePermissionTrait;
    protected static ?string $model           = Product::class;
    protected static ?string $navigationLabel = 'Products';
    protected static ?string $navigationGroup = 'Products';
    protected static ?int $navigationSort     = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Product Tabs')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('General')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Forms\Components\TextInput::make('name')->required()->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $state, callable $set) {
                                    $set('slug', Str::slug($state));
                                })
                                ->helperText('Enter the product name as it will appear to customers.'),
                            Forms\Components\TextInput::make('slug')->required()->maxLength(255)
                                ->helperText('Unique URL slug for the product. Auto-generated from the name.'),
                            Forms\Components\Textarea::make('description')
                                ->helperText('Detailed product description.'),
                            Forms\Components\Select::make('category_id')
                                ->label('Category')
                                ->relationship('category', 'name')
                                ->nullable()
                                ->helperText('Assign a category for better organization.'),
                            Forms\Components\TextInput::make('stock')
                                ->required()
                                ->label('Stock')
                                ->nullable()
                                ->numeric()
                                ->helperText('Set the stock for this product.'),
                            Forms\Components\TextInput::make('sku')->required()->label('SKU')->maxLength(100)->nullable()
                                ->helperText('Stock Keeping Unit identifier for the product.'),
                            Forms\Components\Select::make('status')
                                ->options([
                                    'draft'    => 'Draft',
                                    'active'   => 'Active',
                                    'archived' => 'Archived',
                                ])
                                ->default('draft')
                                ->required()
                                ->helperText('Set the product status.'),

                            Forms\Components\TextInput::make('price')
                                ->required()
                                ->label('Product Price')
                                ->numeric()
                                ->helperText('Set the single price for this product.'),

                            Forms\Components\Toggle::make('is_featured')
                                ->label('Is Featured')
                                ->default(false),

                            Forms\Components\Toggle::make('track_quantity')
                                ->label('Track Quantity')
                                ->default(false),

                        ]),

                    Forms\Components\Tabs\Tab::make('Media')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            Forms\Components\FileUpload::make('thumbnail')
                                ->label('Thumbnail')
                                ->image()
                                ->directory('products/thumbnails')
                                ->nullable()
                                ->helperText('Main product image (shown in listings).')
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                                ->maxSize(2048),
                            Forms\Components\FileUpload::make('gallery')
                                ->label('Gallery Images')
                                ->image()
                                ->multiple()
                                ->directory('products/gallery')
                                ->nullable()
                                ->helperText('Additional images for the product gallery.')
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                                ->maxSize(2048),
                        ]),
                    Forms\Components\Tabs\Tab::make('SEO')
                        ->icon('heroicon-o-magnifying-glass')
                        ->schema([
                            Forms\Components\TextInput::make('meta_title')->label('Meta Title')->maxLength(255),
                            Forms\Components\Textarea::make('meta_description')->label('Meta Description'),
                            Forms\Components\TextInput::make('meta_keywords')->label('Meta Keywords'),
                            Forms\Components\TextInput::make('tags')->label('Tags')
                                ->helperText('Enter tags separated by commas.'),
                        ]),
                ])->maxWidth('full')
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('thumbnail')->label('Thumbnail')->size(40),
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('price')->label('Price')->sortable(),
            Tables\Columns\TextColumn::make('stock')
                ->label('Stock'),
            Tables\Columns\TextColumn::make('status')->sortable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ])->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'draft'    => 'Draft',
                    'active'   => 'Active',
                    'archived' => 'Archived',
                ]),
        ])->actions([
            Tables\Actions\EditAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
