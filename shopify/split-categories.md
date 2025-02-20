# Shopify Guide: Editing Category Descriptions

## Steps to Modify Category Descriptions in Shopify

### 1. Access Your Shopify Admin
1. Log in to your Shopify admin.
2. Navigate to **"Online Store"** under Sales Channels.
3. Click on **"Themes"** (if you are not already there).
4. Click on the button with three dots (**⋮**) and select **"Edit Code"**.

### 2. Locate the Category Template File
You will see a list of `.liquid` files. To find the correct file containing the category description, look for files related to **categories** and search for:

```liquid
collection.description
```

This is the default code for descriptions, which we need to modify.

### 3. If You Cannot Find the File
Follow these steps to locate the correct file:

1. **Check which template is used for categories (collections):**
   - Go to **Shopify Admin → Online Store → Themes**.
   - Click **Customize** on your active theme.
   - Navigate to a **collection page**.
   - Click **Theme Settings** or **Sections** to see which template is selected.

2. **Alternative Method:**
   - Download your theme and use a tool like **WinGrep** to search for specific keywords.
   - Use your browser’s **Inspect Element** tool to find the correct file by searching for `collection-hero` or similar elements.
   - Example files:
     - `main-collection-banner.liquid`
     - `main-collection-product-grid.liquid` (for bottom descriptions)

### 4. Modify the Code
Once you have located the file, replace the existing code. You might find something like this:

```liquid
<div class="collection-hero__description rte">{{ collection.description }}</div>
```

Replace it with:

```liquid
<div class="collection-hero__description rte">
  {% assign descriptions = collection.description | split: "<split>" %}
  {% assign short_desc = descriptions[0] %}
  {% assign long_desc = descriptions[1] %}
</div>
```

Now, insert `{{ short_desc }}` or `{{ long_desc }}` depending on which description you want to display first.

### 5. Using `<split>` to Separate Descriptions
The `<split>` keyword allows you to divide your description into multiple parts. When adding descriptions in Shopify:
- You may need to enable **code mode** in the description editor.
- Click **"Show Editor"** in the top right corner of the editing window.
- Insert `<split>` at the appropriate position within your descriptions.

### 6. Displaying Descriptions in Different Sections
By using `<split>`, you can display a **short description** at the top of the page and a **longer description** at the bottom. To achieve this, modify your theme's `.liquid` files to place `{{ short_desc }}` at the top and `{{ long_desc }}` further down, depending on your design preferences.

This method gives you greater control over how category descriptions are displayed on your Shopify store.
